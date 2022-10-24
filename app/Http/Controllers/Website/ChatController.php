<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Messages\Send;
use App\Notifications\NewCustomerMessageNotify;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessageNotify;
use App\Traits\FirebaseTrait;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Admin;
use Throwable;

class ChatController extends Controller
{
    use FirebaseTrait;
    protected $data = [];



    public function chat($message_id){
        $user_id = auth()->user()->id;
        $this->data['message'] = Message::with('Children')
        ->chatUsers($user_id)
        ->findOrFail($message_id);
        Message::where('parent_id',$message_id)->update(['seen'=> '1']);
        return view('website.chat.chat', $this->data);
    }

    public function newMessage(Request $request){
        $user = auth()->user();
        $user_id = $user->id;
        $user_name = $user->name;
        $user_email = $user->email;
        $this->data['main_message'] = Message::chatUsers($user_id)->find($request->parent_id);
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
        $user_id2 = $this->data['main_message']->user_id2;
        if($user_id2 == $user_id){
            $user_id2 = $this->data['main_message']->user_id;
        }
        // Notification::send($admins, new NewMessageNotify($this->data['message']));
        $view = view('website.chat.me', $this->data)->render();
        $html = view('website.chat.from', $this->data)->render();
        $more_data['html'] = $html;
        $this->desktopNotifications('رسالة جديدة' , $this->data['message']->message, '', [$user_id2], $more_data);
        return response()->json(['html' => $view]);
    }
    public function storeFile(Request $request)
    {
       request()->validate([
        'file'     => 'required',
         'file.*'  => 'mimes:pdf,png,jpeg,jpg|max:2048',
       ]);
       $user = auth()->user();
       $user_id = $user->id;
       $user_name = $user->name;
       $user_email = $user->email;
       $this->data['main_message'] = Message::chatUsers($user_id)->find($request->parent_id);
       if(is_null($this->data['main_message'])){
        $view = "";
        return response()->json(['html' => $view]);
       }
       $more_data['html'] = "";
        if ($files = $request->file('file')) {
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension(); // you can also use file name
                $fileName = uniqid().time().'.'.$extension;
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
                $user_id2 = $this->data['main_message']->user_id2;
                if($user_id2 == $user_id){
                    $user_id2 = $this->data['main_message']->user_id;
                }
                $view = view('website.chat.me', $this->data)->render();
                $html = view('website.chat.from', $this->data)->render();
                $more_data['html'] .= $html;
            }
            $this->desktopNotifications('رسالة جديدة' , $this->data['message']->message, '', [$user_id2], $more_data);
            return response()->json(['html' => $view]);

        }

        $view = "";
        return response()->json(['html' => $view]);
    }


    public function checkMessagesCount()
    {
        if(!auth()->check()){
            return response()->json(["error" => 1, "data" => '0']);
        }
        try {
            $user_id = auth()->id();
            $un_seen_messages_count = Message::whereHas('parent' , function($q) use ($user_id){
                return $q->chatUsers($user_id);
            })->whereNotNull('parent_id')->where('seen', '0')->count();
            return response()->json(["error" => 0,"data" => $un_seen_messages_count]);
        } catch (Exception $e) {
            return response()->json(["error" => 1, "data" => '0']);
           }
    }

    public function seeNewMessage(Request $request){
//        if($request->last_id == 0){
//            return response()->json(['html' => '']);
//        }
        $user_id = auth()->user()->id;
        $this->data['messages'] = Message::where('parent_id', $request->parent_id)->where('id', '>', $request->last_id)->get();
        if(count($this->data['messages']) > 0){
           foreach($this->data['messages'] as $message){
                $message->seen = '1';
                $message->save();
           }
            $view = view('website.chat.more_children', $this->data)->render();
        }else{
            $view = "";
        }
        return response()->json(['html' => $view]);

    }

    public function open_agent_chat($user_id2){
        $user_id = auth()->user()->id;
        $message = $this->open_new_chat($user_id, $user_id2);
        return redirect()->route('chat.start', ['message_id' => $message->id]);
    }
    public function open_new_chat($user_id, $user_id2){
        $message = Message::where(function($q) use($user_id, $user_id2){
            return $q->where('user_id', $user_id)->where('user_id2', $user_id2)->orWhere(function($q) use($user_id, $user_id2){
                return $q->where('user_id', $user_id2)->where('user_id2', $user_id);
            });
        })->whereNull('entity_id')->whereNull('entity_type')->whereNull('parent_id')->first();
        if (is_null($message)) {
            $message = new Message();
            $message->user_id = $user_id;
            $message->user_id2 = $user_id2;
            $message->subject = "المحادثة الخاصة بين الوكيل والموكل";
            $message->message = "المحادثة الخاصة بين الوكيل والموكل";
            $message->entity_id = null;
            $message->entity_type = null;
            $message->save();
            $message->users()->sync([
                $user_id => ['entity_type' => User::class],
                $user_id2 => ['entity_type' => User::class]
            ]);
        }
        return $message;
    }
}
