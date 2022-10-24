<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Messages\Send;
use App\Notifications\NewCustomerMessageNotify;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotify;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Admin;
use Throwable;

class MessagesController extends Controller
{
    protected $data = [];

    public function form(){
        return view('website.messages.form');
    }

    public function send(Send $request){
        try {
            $message = new Message;
            $message->user_id = auth()->check() ? auth()->user()->id : NULL;
            $message->name = $request->name;
            $message->subject = $request->subject;
            $message->email = $request->email;
            $message->message = $request->message;
            $message->save();
            //ارسال ايميل الى المشرفين
            $admins = Admin::get();
            Notification::send($admins, new NewMessageNotify($message));

        } catch (Throwable $throwable) {
            throw $throwable;
        }
        return redirect()->back()->with("success","تم الإرسال بنجاح");
    }

    public function index(){
        $this->data['messages'] = [];
        return view('website.messages.index', $this->data);
    }

    public function seeMoreMessages(Request $request){
        $user_id = auth()->user()->id;
        $this->data['messages'] = Message::where( function ($query) use ($user_id) {
            $query->where('user_id', '=', $user_id)
                ->orWhere('user_id2', '=', $user_id);
        })->whereNull('parent_id') ->orderBy('created_at','desc')->paginate(10);
        if(count($this->data['messages']) > 0){
//            Message::whereHas('parent' , function($q) use ($user_id){
//                return $q->where('user_id', $user_id);
//            })->whereNotNull('parent_id')->where('seen', '0')->update(['seen'=> '1']);
            $view = view('website.messages.message_row', $this->data)->render();
        }else{
            $view = "";
        }
        return response()->json(['html' => $view]);

    }

    public function chat($message_id){
        $user_id = auth()->user()->id;
        $this->data['message'] = Message::with('Children')->where('user_id', $user_id)->findOrFail($message_id);
        Message::where('parent_id',$message_id)->update(['seen'=> '1']);
        return view('website.messages.chat', $this->data);
    }

    public function newMessage(Request $request){
        $user = auth()->user();
        $user_id = $user->id;
        $user_name = $user->name;
        $user_email = $user->email;
        $this->data['main_message'] = Message::where('user_id', $user_id)->find($request->parent_id);
        if(is_null($this->data['main_message'])){
            $view = "";
            return response()->json(['html' => $view]);
        }
        $this->data['message'] = new Message;
        $this->data['message']->subject = "رسالة";
        $this->data['message']->parent_id = $request->parent_id;
        $this->data['message']->user_id = $user_id;
        $this->data['message']->message = $request->message;
        $this->data['message']->name = !empty($user_name) ? $user_name : "";
        $this->data['message']->email = !empty($user_email) ? $user_email : "";
        $this->data['message']->save();
        $admins = Admin::get();
        Notification::send($admins, new NewMessageNotify($this->data['message']));
        $view = view('website.messages.me', $this->data)->render();
        return response()->json(['html' => $view]);
    }
    public function storeFile(Request $request)
    {
       request()->validate([
         'file'  => 'required|mimes:pdf,png,jpeg,jpg|max:2048',
       ]);
       $user = auth()->user();
       $user_id = $user->id;
       $user_name = $user->name;
       $user_email = $user->email;
       $this->data['main_message'] = Message::where('user_id', $user_id)->find($request->parent_id);
       if(is_null($this->data['main_message'])){
        $view = "";
        return response()->json(['html' => $view]);
       }
        if ($file = $request->file('file')) {

            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time().'.'.$extension;
            $path = '/storage/chat_files';
            $uplaod = $file->move(public_path().$path,$fileName);
            $file_name = $path . "/" .$fileName;
            $this->data['message'] = new Message;
            $this->data['message']->subject = "ملف مرفق";
            $this->data['message']->parent_id = $request->parent_id;
            $this->data['message']->user_id = $user_id;
            $this->data['message']->message = "";
            $this->data['message']->name = !empty($user_name) ? $user_name : "";
            $this->data['message']->email = !empty($user_email) ? $user_email : "";
            $this->data['message']->file = $file_name;
            $this->data['message']->save();

            $view = view('website.messages.me', $this->data)->render();
            return response()->json(['html' => $view]);

        }

        $view = "";
        return response()->json(['html' => $view]);
    }
}
