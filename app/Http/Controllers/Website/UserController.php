<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Models\Review;
use App\Models\User;
use App\Traits\OdooTrait;
use App\Traits\SMSTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Auth;
use Hash;
use Illuminate\Validation\Rule;
use Response;
use Session;
use App\Rules\MatchOldPassword;
use App\Traits\UserLogTreat;
use App\Notifications\SendCustomEmailsToUser;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Helpers\HelperClass;
/**
 * Class UserController
 * @package App\Http\Controllers\Website
 */
class UserController extends Controller
{
    use SMSTrait;
    use UserLogTreat;
    use OdooTrait;
    /**
     * @return View
     */
    public function profile(): View
    {
        $this->data['user']     = User::find(auth()->id());
        $width = 0;

        if(!empty($this->data['user']->creditCard)){
            $width+= 25;
        }
        if(!empty($this->data['user']->image)){
            $width+= 25;
        }
        if(!empty($this->data['user']->full_name)){
            $width+= 25;
        }
        if(!empty($this->data['user']->email)){
            $width+= 25;
        }

        $this->data['width']    = $width;
        return view('website.user.profile', $this->data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateProfile(Request $request)
    {
        //return Session::get('verification_code');

        $emailphoneChanaged = [];
        try {
            $user = auth()->user();
            if (isset($request->password)) {
                $validated = $request->validate([
                    'password' => 'required|confirmed|min:8|regex:/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/',
                    'current_password' =>  ['required', new MatchOldPassword],
                ]);
                User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
                $this->updateUserOdoo($user, $request->password);

                $action         = 'تعديل كلمة المرور';
                $description    = 'تعديل كلمة المرور للمستخدم ' . $user->name;
                $this->AddUserLog($user,$action,$description);

                return back()->with(['success' => 'تم تعديل كلمة المرور بنجاح !']);
            } else
            {
                $request->validate([
                    'phone' => 'required|unique:users,phone,' . $user->id,
                    'email' => 'required_if:activation_type,email',
                    'name' => 'required',
                    'nationality' => 'required',
                    'activation_type' => 'required',
                    'address' => 'required',
                    'file'  => 'nullable|mimes:png,jpeg,jpg|max:2048',
                    'commercial_register'  => 'nullable|mimes:png,jpeg,jpg,pdf|max:2048',

                    'facebook' => 'nullable|string|max:255',
                    'instagram' => 'nullable|string|max:255',
                    'linkedin' => 'nullable|string|max:255',
                    'twitter' => 'nullable|string|max:255',
                    'whatsapp' => 'nullable|string|max:255',
                ]);

                if ($user->email && $request->email != $user->email && $user->email!='') {
                    $emailphoneChanaged['email-code'] = $request->email;
                }
                    $user->email = $request->email;


                if ($request->phone != $user->phone) {
                    $emailphoneChanaged['phone-code'] = $request->phone;
                }
                    $user->phone = $request->phone;

                $in_review = '0';
                if ($file = $request->file('file')) {
                    $extension = $file->getClientOriginalExtension(); // you can also use file name
                    $fileName = time() . '.' . $extension;
                    $path = '/storage/uploads';
                    $uplaod = $file->move(public_path() . $path, $fileName);
                    $file_name = $path . "/" . $fileName;
                    $user->file = $file_name;
                    $in_review = '1';

                }
                if ($file = $request->file('commercial_register')) {
                    $extension = $file->getClientOriginalExtension(); // you can also use file name
                    $fileName = 'cr'.time() . '.' . $extension;
                    $path = '/storage/uploads';
                    $uplaod = $file->move(public_path() . $path, $fileName);
                    $file_name = $path . "/" . $fileName;
                    $user->commercial_register = $file_name;
                    $in_review = '1';
                }
                $user->name = $request->name;
                $user->nationality = $request->nationality;
                $user->address = $request->address;
                $user->activation_type = $request->activation_type;
                $user->in_review = $in_review;

                $user->facebook     = $request->facebook;
                $user->instagram    = $request->instagram;
                $user->linkedin     = $request->linkedin;
                $user->twitter      = $request->twitter;
                $user->whatsapp     = $request->whatsapp;

                $this->updateUserOdoo($user, 'null');

                $action         = 'تعديل حساب';
                $description    = 'تعديل حساب للمستخدم ' . $user->name;
                $this->AddUserLog($user,$action,$description);
            }




            $user->save();

            $v_code = rand(1000, 9999);

            // Session::put('verification_code', $verification_code);
            $user->v_code = $v_code;
            $user->save();

            if (isset($emailphoneChanaged['email-code']) && isset($emailphoneChanaged['phone-code'])) {
                // Session::put('email', $emailphoneChanaged['email-code']);
                // Session::put('phone', $emailphoneChanaged['phone-code']);

                $user->email_code = $emailphoneChanaged['email-code'];
                $user->phone_code = $emailphoneChanaged['phone-code'];
                $user->save();

                // \Mail::to($user->email)->send(new \App\Mail\ReplyMail([
                //     'title' => 'كود تغيير الإيميل',
                //     'body' => 'كود إعادة تعيين الحساب في منصة معاملة: '.$v_code
                // ]));

                $title      = 'السلام عليكم ' . $user->name;
                $message1   = '';
                $message2   = 'كود تغيير الإيميل ';
                $message3   = 'كود إعادة تعيين الحساب في منصة معاملة: '.$v_code;
                $this->sendEmail($title,$message1,$message2,$message3,$user->email);

                $this->sendSMS($user->phone, 'كود إعادة تعيين الحساب في منصة معاملة: '.$v_code);
                return redirect('/user/codes/verify');
            }

            if (isset($emailphoneChanaged['email-code'])) {
                // Session::put('email', $emailphoneChanaged['email-code']);
                $user->email_code = $emailphoneChanaged['email-code'];
                $user->save();

                // \Mail::to($user->email)->send(new \App\Mail\ReplyMail([
                //     'title' => 'كود تغيير الإيميل',
                //     'body' => 'كود إعادة تعيين الحساب في منصة معاملة: '.$v_code
                // ]));

                $title      = 'السلام عليكم ' . $user->name;
                $message1   = '';
                $message2   = 'كود تغيير الإيميل ';
                $message3   = 'كود إعادة تعيين الحساب في منصة معاملة: '.$v_code;
                $this->sendEmail($title,$message1,$message2,$message3,$user->email);

                return redirect('/user/email-code/verify');
            }

            if (isset($emailphoneChanaged['phone-code'])) {
                // Session::put('phone', $emailphoneChanaged['phone-code']);
                $user->phone_code = $emailphoneChanaged['phone-code'];
                $user->save();

                $this->sendSMS($user->phone, 'كود إعادة تعيين الحساب في منصة معاملة: '.$v_code);
                return redirect('/user/phone-code/verify');
            }

            return back()->with(['success' => 'تم التعديل على بياناتك الشخصية بنجاح !']);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateCreditCard(Request $request): RedirectResponse
    {
        try {
            CreditCard::updateOrCreate(
                ['user_id' => Auth::id()],
                $request->all() + ['user_id' => Auth::id()]
            );

            $user           = auth()->user();
            $action         = 'تعديل الحساب البنكي';
            $description    = 'تعديل الحساب البنكي للمستخدم ' . $user->name;
            $this->AddUserLog($user,$action,$description);

            return back()->with(['success' => 'تم التعديل بنجاح !']);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
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
    //reviews
    public function reviews(Request $request)
    {
        $user = User::with(['avgReviews', 'services'])->find(auth()->id());

        //dd($user);
        return view('website.user.reviews',['user'=>$user]);

    }

    public function makeReviews(Request $request)
    {
        return 1;
    }

    public function unreadNotifications()
    {
        try {
            $notifications = Auth::user()->unreadNotifications;
            $view = view('website.user.notifications', compact('notifications'))->render();
            return response()->json(["error" => 0,"data" => $view]);
        } catch (Exception $e) {
            return response()->json(["error" => 1, "data" => '00000']);
           }
    }

    public function share_profile($slug,$type = null){
        $id             =request()->id;
        $type           =request()->type;

        $user           = User::with('avgReviews')->findOrFail($id);
        // $reviews = $user->reviews()->with('owner')->paginate(1);
        // $services = $user->services()->paginate(1);
        $avg_reviews    = $user->avgReviews->first();
        $total_avg      = 0;
        if(!is_null($avg_reviews)){
            $total = 0;
            $total += $avg_reviews->quality_of_service;
            $total += $avg_reviews->execution_speed;
            $total += $avg_reviews->professionalism_in_dealing;
            $total += $avg_reviews->communication;
            $total += $avg_reviews->deal_with_him_again;
            $total_avg = $total / 5;
        }
        return view('website.user.share_profile', compact('user', 'total_avg', 'avg_reviews','type'));
    }

    public function show_more_services($id){
        $user = User::findOrFail($id);
        $services = $user->services()->paginate(10);
//        dd($user->services()->first());
        $view = "";
        if(count($services)){
            $view = view('website.user.service_row', compact('services'))->render();
        }
        return response()->json(['html' => $view]);
    }

    public function show_more_reviews($id){
        $user       = User::findOrFail($id);
        $reviews    = $user->reviews()->with('owner')->paginate(10);
        $view = "";
        if(count($reviews)){
            $view =  view('website.user.review_row', compact('reviews'))->render();
        }
        return response()->json(['html' => $view]);

    }

    public function selectAgent(Request $request){
        $user = auth()->user();
        if(is_null($user)){
            return response(['message' => 'لا تملك الصلاحية للقيام بهذه العملية'], 401);

        }
        try{
            $user->agent_id = $request->agent_id;
            $user->save();
            return back()->with(['success' => 'تم تحديد الوكيل الخاص بك بنجاح !']);
        }catch (Throwable $throwable) {
            return back()->with(['error' => 'حدث خطأ !']);
        }

    }

    public function agents_list(Request $request){
        $user = auth()->user();
        if(is_null($user)){
            return response(['error' => 'لا تملك الصلاحية للقيام بهذه العملية'], 401);

        }
        return view('website.user.agents_list');
    }

    public function agents_more_data(){
        $user = auth()->user();
        if($user->IsAgent()){
            $users = User::where('agent_id', $user->id)->paginate(10);
        }else{
            $users = User::where('in_review', '0')->where('is_agent', '1')->where('id', '!=', $user->id)->paginate(10);
        }
        $view = "";
        if(count($users)){
            $view = view('website.user.agent_row', compact('users'))->render();
        }
        return response()->json(['html' => $view]);
    }
    public function set_agent(Request $request){
        $agent_id = $request->agent_id;
        $user = auth()->user();
        if($agent_id == $user->id){
            abort(404);
        }
        $user->agent_id = $agent_id;
        $user->save();
        $agent = User::findOrFail($agent_id);
        $share_link = route('share_profile', ['slug'=> HelperClass::strtoslug($user->getName()), 'id'=>$user->id,$user->level]);
        $message = [
            'message' => " تم توكيلك من قبل : ". $user->getName(),
            'link' => $share_link,
        ];
        Notification::send($agent, new \App\Notifications\NotifyAgent([], $message));
        return redirect()->route('user.agents_list')->with(['success' => 'تم تحديد الوكيل الخاص بك بنجاح !']);
    }

    public function cancel_agent(Request $request){
        $agent_id = $request->agent_id;
        $user = auth()->user();
        if($agent_id == $user->id){
            abort(404);
        }
        $user->agent_id = null;
        $user->save();
        $agent = User::findOrFail($agent_id);
        $share_link = route('share_profile', ['slug'=> HelperClass::strtoslug($user->getName()), 'id'=>$user->id,$user->level]);
        $message = [
            'message' => " تم إلغاء التوكيل من قبل : ". $user->getName(),
            'link' => $share_link,
        ];
        Notification::send($agent, new \App\Notifications\NotifyAgent([], $message));
        return redirect()->route('user.agents_list')->with(['success' => 'تم إلغاء الوكالة بنجاح !']);
    }

    public function refuse_agent(Request $request){
        $client_id = $request->client_id;
        $user = auth()->user();
        if($client_id == $user->id){
            abort(404);
        }
        $client = User::where('agent_id', $user->id)->findOrFail($client_id);
        $client->agent_id = null;
        $client->save();
        $share_link = route('share_profile', ['slug'=> HelperClass::strtoslug($user->getName()), 'id'=>$user->id,$user->level]);
        $message = [
            'message' => " تم رفض التوكيل من قبل الموكل : ". $user->getName(),
            'link' => $share_link,
        ];
        Notification::send($client, new \App\Notifications\NotifyAgent([], $message));
        return redirect()->route('user.agents_list')->with(['success' => 'تم رفض طلب التوكيل !']);
    }

    public function storeFiles(Request $request) {

        $request->validate([
            'file'  => 'nullable|mimes:png,jpeg,jpg|max:2048',
            'commercial_register'  => 'nullable|mimes:png,jpeg,jpg,pdf|max:2048',
        ]);
        $user = auth()->user();
        $in_review = '0';
        if ($file = $request->file('file')) {
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = '/storage/uploads';
            $uplaod = $file->move(public_path() . $path, $fileName);
            $file_name = $path . "/" . $fileName;
            $user->file = $file_name;
            $in_review = '1';

        }
        if ($file = $request->file('commercial_register')) {
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = 'cr'.time() . '.' . $extension;
            $path = '/storage/uploads';
            $uplaod = $file->move(public_path() . $path, $fileName);
            $file_name = $path . "/" . $fileName;
            $user->commercial_register = $file_name;
            $in_review = '1';
        }
        $user->in_review=$in_review;
        $user->save();
        return response (['url' => $file_name], 200);
    }
}
