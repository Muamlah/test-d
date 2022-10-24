<?php

namespace App\Http\Controllers\Website;

//use App\Models\Offer;
use App\Helpers\HelperClass;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
//use App\Models\Build\BuildDep;
//use App\Models\ElectronicServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Website\Settings\UpdateImage;
use App\Http\Requests\Website\Settings\UpdateProfile;
use App\Models\Page;
use App\Models\FirebaseToken;
use Auth;
use App\Traits\CommonTrait;
use App\Models\Settings;
use App\Models\User;
use App\Notifications\SendCustomEmailsToUser;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Traits\SMSTrait;

/**
 * Class SettingsController
 * @package App\Http\Controllers\Website
 */
class SettingsController extends Controller
{
    use CommonTrait , SMSTrait;

    public function checkCode(){

        $genrated_code      = $this->generateRandomString();
        $check_user         = User::where('reference_code',$genrated_code)->first();

        if(!empty($check_user)){
            $this->checkCode();
        }

        return $genrated_code;
    }
    public function index():View
    {
        $user = auth()->user();
        $id =$user->id;
        if($user->name==''){
            $user->name=$user->full_name;
        }

        if(empty($user->reference_code)){

            $user->reference_code = $this->checkCode();
            $user->save();

        }

        if(!empty($user->reference_code)){
            $user->createCoupon();
        }
        $share_link = route('share_profile', ['slug'=> HelperClass::strtoslug(!empty($user->name) ? $user->name : $user->phone), 'id'=>$user->id,$user->level]);

        $timestamp = \Carbon\Carbon::parse($user->created_at)->timestamp;
        $file_name = $timestamp . '-' . $id;
        $qr_image_link = $this->getQrCode($share_link, $file_name);

        $setting = Settings::first();

        return view('website.settings.index', compact('share_link', 'qr_image_link','setting'));

    }
    public function public_settings(){
        $this->data['pages'] = Page::get();
        return view('website.settings.public', $this->data);
    }
    public function tellFriend(){
        return view('website.settings.tell_friend', $this->data);
    }
    public function tellFriendPost(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        if(!empty($request->email))
        {
            $title      = 'دعوة للإنضمام إلى منصة معاملة';
            $message1   = 'لديك دعوة للإنضمام إلى منصة معاملة من قبل' . !empty($user->name) ? $user->name : $user->phone;
            $message2   = 'للتسجيل يرجى التسجيل عن طريق الرابط التالي: ';
            $message3   = 'https://app.muamlah.com/customer-register';
            $this->sendEmail($title,$message1,$message2,$message3,$request->email);
        }
        if(!empty($request->phone))
        {
            $this->sendSMS($request->phone, $message1 . ' ' . $message2 . ' ' . $message3);
        }
        return redirect()->back()->with('success','تم الارسال بنجاح');
    }
    public function sendEmail($title,$message1,$message2,$message3,$email){

        $info = [
            'title'             => $title,
            'message1'          => $message1,
            'message2'          => $message2,
            'message3'          => $message3,
        ];

        Mail::to($email)->send(new SendCustomEmailsToUser($info));
    }
    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function updateProfileImage(UpdateImage $request){
        $user = auth()->user();
        if(is_null($user)){
            return response(['message' => 'لا تملك الصلاحية للقيام بهذه العملية'], 401);
        }
        try{
            $image = $this->storeImage($user);
            return response (['url' => asset('/storage').'/'.$image], 200);
        }catch (Throwable $throwable) {
            throw $throwable;
        }

    }
    public function updateProfile(UpdateProfile $request){
        $user = auth()->user();
        if(is_null($user)){
            return response(['message' => 'لا تملك الصلاحية للقيام بهذه العملية'], 401);
        }
        try{
            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->save();
            return response (['name' => $user->name,'bio' => $user->bio], 200);
        }catch (Throwable $throwable) {
            throw $throwable;
        }

    }

    private function storeImage($user) {


        if(request()->hasFile('image')) {

        $file = request()->file('image');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = time().'.'.$extension;
        $path = public_path().'/storage/uploads';
        $uplaod = $file->move($path,$fileName);

        $user->image = 'uploads/'.$fileName;
        $user->save();

        return $user->image;
        }

    }

    public function updateWorkStatus(UpdateProfile $request){
        $user = auth()->user();

        if(is_null($user)){
            return response(['message' => 'لا تملك الصلاحية للقيام بهذه العملية'], 401);
        }

        try{

            $user->work_status  = $request->work_status;
            $user->save();
            return response (200);

        }catch (Throwable $throwable) {
            throw $throwable;
        }

    }

    public function notifications(){
        $this->data['eservices_orders_notifications'] = '0';
        $this->data['public_private_orders_notifications'] = '0';
        $token = FirebaseToken::where('user_id', auth()->id())->where('type', 'WEB')->first();
        if(!is_null($token)){
            $this->data['eservices_orders_notifications'] = $token->eservices_orders_notifications;
            $this->data['public_private_orders_notifications'] = $token->public_private_orders_notifications;
        }
        return view('website.settings.notifications', $this->data);

    }

    public function update_notification_status(Request $request){
        $token = FirebaseToken::where('user_id', auth()->id())->where('type', 'WEB')->first();
        if(!is_null($token)){
            $token->{$request->type} = $request->status;
            $token->save();
        }
    }

}
