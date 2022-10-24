<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Messages\Reply;
use App\Models\eservices_orders;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\User;
use App\Traits\FirebaseTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotify;
use App\Notifications\NewCustomerMessageNotify;
use App\Http\Resources\Message\MessageCollection;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Admin;
use phpDocumentor\Reflection\Type;
use Throwable;
use Auth;

/**
 *
 */
class MessagesController extends Controller
{
    use FirebaseTrait;

    protected $data = [];
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('canPermission:READ_MESSAGES');


    }

    /**
     * @return Application|Factory|View
     */
    public function index(){
//        $this->data['message'] = Message::whereNull('parent_id')->limit(100)->orderBy('','DESC')->get();

        return view('admin.messages.index');
    }

    /**
     * @param $type
     * @param $id
     * @return RedirectResponse
     */
    public function get_messages($type, $id): RedirectResponse
    {
        if ($type=='private') {
         $entity_type=   PrivateOrder::class;
            $order = PrivateOrder::findOrFail($id);
            $user_id2 = $order->provider_id;
            if($user_id2 == Auth::id()){
                $user_id2 = $order->user_id;
            }
            $subject  = 'تعميد خاص رقم '.$id;

        }elseif($type=='public'){
            $entity_type=   PublicOrder::class;
            $order = PublicOrder::findOrFail($id);
            $user_id2 = $order->provider_id;
            if($user_id2 == Auth::id()){
                $user_id2 = $order->user_id;
            }
            $subject  = 'تعميد عام رقم '.$id;

        }elseif($type=='eservices'){
            $entity_type=   eservices_orders::class;
            $order = eservices_orders::findOrFail($id);
            $user_id2 = $order->provider_id;
            if($user_id2 == Auth::id()){
                $user_id2 = $order->user_id;
            }
            $subject  = 'خدمة رقم '.$id;

        }
        $exists=Message::where('entity_id',$id)->where('entity_type', $entity_type)->first();
        if (!$exists) {
            $message = new Message();
            $message->user_id = Auth::id();
            $message->subject = $subject;
            $message->message = $subject;
            $message->entity_id = $id;
            $message->entity_type =$entity_type;
            $message->save();

            $message->users()->sync([
                $order->user_id => ['entity_type' => User::class],
                $order->provider_id => ['entity_type' => User::class]
            ]);

            $new_id=$message->id;
        }else{
            $new_id=$exists->id;
        }

        return redirect()->route('admin.messages.show',$new_id);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request){
        $this->data['message'] = Message::with('Children')->findOrFail($request->id);
        $user_id = auth()->user()->id;
        $has = $this->data['message']->admins()->where('entity_id', $user_id)->first();
        if(is_null($has)){
            $this->data['message']->admins()->sync([
                Auth::id() => ['entity_type' => Admin::class],
            ]);
        }
        $this->data['message']->seen_by_admin = '1';
        $this->data['message']->save();
        if(count($this->data['message']->Children)){
            foreach($this->data['message']->Children as $Child){
                $Child->seen_by_admin = '1';
                $Child->save();
            }
        }
        return view ('admin.messages.show', $this->data);
    }

    /**
     * @param Request $request
     * @return MessageCollection
     */
    public function get_all(Request $request): MessageCollection
    {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = Message::whereNull('parent_id');
        if($request->has('unseen') && $request->unseen == 1){
            $query = Message::where('seen_by_admin', '0')
            ->where(function($q){
                $q->whereNull('parent_id')->orWhereHas('children', function($q){
                    $q->where('seen_by_admin', 0);
                });
            });

        }else{
            $query = Message::whereNull('parent_id');

        }
        if ( $request->input('query.generalSearch')!=null) {
            $query->where('message','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('reply','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('email','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('name','like','%'.$request->input('query.generalSearch').'%')
            ->orWhere('subject','like','%'.$request->input('query.generalSearch').'%');
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new MessageCollection($data));
    }

    /**
     * @throws Throwable
     */
    public function reply(Reply $request){
        try {
            $message = Message::findOrFail($request->message_id);
            $message->user_id = auth()->user()->id;
            $message->reply = $request->reply;
            $message->reply_at =\Carbon\Carbon::now();
            $message->save();
            //ارسال ايميل الى للعميل
            $details = [
                'title' => 'السيد: '.$message->name,
                'body' => $message->reply
            ];

            \Mail::to($message->email)->send(new \App\Mail\ReplyMail($details));

        } catch (Throwable $throwable) {
            throw $throwable;
        }
        return redirect()->route('admin.messages.show', ['id' => $message->id])->with('success', 'تم الإرسال بنجاح');
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function newMessage(Request $request): JsonResponse
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_name = $user->name;
        $user_email = $user->email;
        $this->data['main_message'] = Message::findOrFail($request->parent_id);
        $this->data['main_message']->reply_at =\Carbon\Carbon::now();
        $this->data['main_message']->update();
        if(is_null($this->data['main_message'])){
            $view = '';
            return response()->json(['html' => $view]);
        }
        $this->data['message'] = new Message();
        $this->data['message']->subject = 'رد على الرسالة';
        $this->data['message']->parent_id = $request->parent_id;
        $this->data['message']->user_id = $user_id;
        $this->data['message']->message = $request->message;
        $this->data['message']->name = !empty($user_name) ? $user_name : '';
        $this->data['message']->email = !empty($user_email) ? $user_email : '';
        $this->data['message']->save();

//        $details = [
//            'title' => 'السيد: '.$this->data['message']->name,
//            'body' => $this->data['message']->message
//        ];
       $ids= $this->data['main_message']->users->pluck('id');
        // \Mail::to($this->data['main_message']->email)->send(new \App\Mail\ReplyMail($details));
//        Notification::send($user, new NewCustomerMessageNotify($this->data['message']));
        $view = view('admin.messages.me', $this->data)->render();
        $this->desktopNotifications('رسالة جديدة' , $this->data['message']->message, '', $ids, '');
        return response()->json(['html' => $view]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function seeNewMessage(Request $request): JsonResponse
    {
        $user_id = auth()->user()->id;
        $this->data['messages'] = Message::where('parent_id', $request->parent_id)->where('user_id', '!=', $user_id)->where('id', '>', $request->last_id)->get();
        if (count($this->data['messages']) > 0) {
            foreach ($this->data['messages'] as $message) {
                $message->seen = '1';
                $message->save();
            }
            $view = view('admin.messages.from', $this->data)->render();
        } else {
            $view = '';
        }
        return response()->json(['html' => $view]);


    }

    /**
     * @return JsonResponse
     */
    public function checkMessagesCount(): JsonResponse
    {
        if(!auth()->check()){
            return response()->json(['error' => 1, 'data' => '0']);
        }
        try {
            $un_seen_messages_count = Message::where('seen_by_admin', '0')
            ->where(function($q){
                $q->whereNull('parent_id')->orWhereHas('children', function($q){
                    $q->where('seen_by_admin', 0);
                });
            })->count();
            return response()->json(['error' => 0, 'data' => $un_seen_messages_count]);
        } catch (Exception $e) {
            return response()->json(['error' => 1, 'data' => '0']);
           }
    }

    /**
     * @return JsonResponse
     */
    public function unreadNotifications(): JsonResponse
    {
        try {
            $notifications = Message::where('seen_by_admin', '0')
            ->where(function($q){
                $q->whereNull('parent_id')->orWhereHas('children', function($q){
                    $q->where('seen_by_admin', 0);
                });
            })->orderBy('id','DESC')->get();
            $view = view('admin.include.notifications', compact('notifications'))->render();
            return response()->json(['error' => 0, 'data' => $view]);
        } catch (\Exception $e) {
            return response()->json(['error' => 1, 'data' => '00000']);
           }
    }

}
