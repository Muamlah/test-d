<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ChatAPI as AdminChatAPI;
use App\Models\ChatbotSession;
use App\Models\eservices_orders;
use App\Models\Faq;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\User;
use App\Traits\ChatBotTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Str;
class ChatAPIController extends Controller
{
use ChatBotTrait;
    public function sendgroupmessage(Request $request) // only with post method!
    {
        if ($request->method() == 'GET') {
            //get list of groups
            $chat_api = new ChatAPI();
            $groups = $chat_api->getGroupsList();
            return view('admin.chatbot.send_group_message', compact('groups'));
        }



        $chat_api = new ChatAPI();
        $result = $chat_api->sendMessage($request['whatsapp-group'], $request['chatbot_message']);
        if ($result['sent'])
            return redirect('/admin/chatbotSendGroupMessage')->with("success", "Created Successfully"); // send id of inserted
        else
            return redirect('/admin/chatbotSendGroupMessage')->with("fail", "some thing went wrong!"); // send id of inserted


    }

    public function creategroup(Request $request) // only with post method!
    {
        $chat_api = new ChatAPI();
        //remove multispaces
        $no_multi_spaces = preg_replace('/\s+/', ' ', $request['group_phones']);

        $phones_array = explode(" ", $no_multi_spaces);
        $result = $chat_api->group(
            $request['group_name'],
            $phones_array,
            $request['group_message']
        );

        if ($result['created'])
            return redirect('/admin/chatbotCreateGroup')->with("success", "Created Successfully"); // send id of inserted
        else
            return redirect('/admin/chatbotCreateGroup')->with("fail", "some thing went wrong!"); // send id of inserted
        //return redirect('/admin/chatbotSendMessages')->with("success", "Created Successfully"); // send id of inserted
        return response()->json($result, 200);

        //        return $chat_api->getgroupinfo('967775521104-1626118830@g.us','sssl');
        //return response()->json(, 200);
    }
    public function senuserguid()
    {
        $chat_api = new ChatAPI();
        return $chat_api->senduserguide('967775205560');
    }

    public function settings(Request $request)
    {
        $jsonString = file_get_contents(base_path('resources/settings/chatapi.json'));
        $jsonString = str_replace('rn','\r\n',$jsonString);

        $data = json_decode($jsonString, true);

        return view('admin.chatbot.settings', $data);
    }
    public function change_settings(Request $request)
    {
        // $no_spaces = preg_replace('/\s+/', ' ', $request->group_supervisors);
        // return $text = explode(" ",$no_spaces);

        $newJsonString = json_encode($request->all(), JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/settings/chatapi.json'), stripslashes($newJsonString));
        //-- set webhook
        $chat_api = new ChatAPI();
        if (filter_var($request['webhook'], FILTER_VALIDATE_URL))
            $chat_api->setWebhook($request['webhook'], true);

        return view('admin.chatbot.settings', $request->all());
    }
    public function sendmessage(Request $request)
    {

        if ($request->has('submit')) {

            $jsonString = file_get_contents(base_path('resources/settings/chatapi.json'));
            $data = json_decode($jsonString, true);
            $chat_api = new ChatAPI($data['token'], 'https://api.chat-api.com/instance' . $data['instance']);

            //$chat_api->sendMessage($request['chatbot_phone'], $request['chatbot_message']);
            $result = $chat_api->sendMessage($request['chatbot_phone'], $request['chatbot_message']);
            if ($result['sent'])
                return redirect('/admin/chatbotSendMessages')->with("success", "Created Successfully"); // send id of inserted
            else
                return redirect('/admin/chatbotSendMessages')->with("fail", "some thing went wrong!"); // send id of inserted
        }
        //

        //return redirect('/admin/chatbotSendMessages')->with("fail","Created Successfully"); // send id of inserted
        return view('admin.chatbot.send_message', $request->all());
    }
    public function home(Request $request)
    {
        return view('welcome');
    }
    // arabic to english convert-function
    protected function number_convert($string)
    {


        $arabic_numbers = [
            "٠",
            "١",
            "٢",
            "٣",
            "٤",
            "٥",
            "٦",
            "٧",
            "٨",
            "٩",
        ];
        $letters = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($letters as $letter)
            if (!in_array($letter, $arabic_numbers)) {
                return $string;
                break;
            }

        $num = range(0, 9);
        $englishNumbersOnly = str_replace($arabic_numbers, $num, $string);


        return $englishNumbersOnly;
    }


    // use get request to set uri 'in browser address bar'
    //example http://yoursite?uri = http://yoursite/webhook

    public function index(Request $request)
    {

        $jsonString = file_get_contents(base_path('resources/settings/chatapi.json'));
        $data = json_decode($jsonString, true);

        //check if source of request different from the official website chat_api

        $host = parse_url(request()->headers->get('referer'), PHP_URL_HOST);

        //if ($host != "chat-api.com")
        //return response()->json($data['time_to_life'], 200);

        // in constructor put ur token with uri that contains instanceNUMBER
        $chat_api = new ChatAPI();

        //here we operate with comming message and make answer to it;
        $content = json_decode($request->getContent(), true); // get assoc array from row data
        if (isset($content['messages'])) {
            //check every new message
            foreach ($content['messages'] as $message) {
//                if (!strpos($message['id'], '@g') !== false) {
//                    return response()->json('Error !', 404);
//                }

                //delete excess spaces and split the message on spaces. The first word in the message is a command, other words are parameters
                $text = explode(' ', trim($message['body']));

                //check if user has entry in session table
                $chat_session = ChatbotSession::where('chatID', $message['chatId'])->first();

                if ($message['fromMe']) {

//                    if (!$chat_session) {
                        return;
//                    }
//                    if ($message['body'] == "شكرا لك على تواصلك معنا") {
//                        $chat_session->type =  'notype';
//                        $chat_session->save();
//                        return;
//                    }
                }

                //current message shouldn't be send from your bot, because it calls recursion
                if (!$message['fromMe']) {
                    $new_dialog = ChatbotSession::where('chatID', $message['chatId'])->where('updated_at', '>=', \Carbon\Carbon::now()->subMinute($data['time_to_life']))->count();
                    $is_parent = Str::contains($message['chatName'], '@');
                    if ($is_parent) {
                        $parent = Str::after($message['chatName'], '@');
                    }
                    $id = Str::between($message['chatName'], '#', '@');
                    if ( !$new_dialog && $message['body'] == 'تم') {
                        if (!$chat_session) {
                            $chat_session =  new ChatbotSession();
                            $chat_session->chatID =  $message['chatId'];
                            $chat_session->type =  $message['type'];
                            $chat_session->message =  $message['body'];
                            $chat_session->save();
                            $chat_api->welcome($message['chatId'], $message['senderName'], true);

                        }else{
                            $chat_session->type =  $message['type'];
                            $chat_session->message =  $message['body'].'_'.time();
                            $chat_session->update();
                        }

                        return ;
                    }

                    if ( Str::contains($message['chatName'], 'خاص')) {
                        $order=  PrivateOrder::find($id);
                        $status_id=$order->getStatus();
                        $type='public';
                    }
                    if ( Str::contains($message['chatName'], 'عام')) {
                        $order=  PublicOrder::find($id);
                        $status_id=$order->status;
                        $type='private';
                    }
                    if ( Str::contains($message['chatName'], 'الكترونية')) {
                        $order=  eservices_orders::find($id);
                        $status_id=$order->status;
                        $type='eservices';
                    }

                    $user=User::find($order->user_id);
                    $is_user = Str::contains($message['author'], $user->phone);
                    $provider=User::find($order->provider_id);
                    $is_provider = Str::contains($message['author'], $provider->phone);
                    echo $is_provider;
//                    echo  $message['body'];
//                    echo  $new_dialog;
                    if ($new_dialog >=1 && $message['body'] == '1') {
//                        echo 1;
                            if ($is_provider) {
//                                $this->bot_change_order_status($order->id,$user->id,1,$type,'Chat Bot',0);
                            }
//                        $chat_api->welcome($message['chatId'], $message['senderName'], true);
                        return ;
                    }
//                    // get number enterd by user
//                    $quest_message = mb_strtolower($text[0], 'UTF-8');
//                    $quest_message = $this->number_convert($quest_message);
//
//                    $quest_count = count(Faq::getTypes()); //number of types --> From Faq Model
//
//                    if (!$chat_session) {
////                        if ($quest_message == "السلام") {
////                            $chat_api->sendMessage(
////                                $message['chatId'],
////                                "وعليكم السلام ورحمة الله وبركاته" .
////                                    "\n" .
////                                    "أهلاً " .
////                                    $message['senderName'] .
////                                    "\n" .
////                                    "أنا مرتاح، المساعد الذكي لخدمة العملاء" .
////                                    "تسعدني خدمتك دائما" .
////                                    "\n" .
////                                    "للإستفسار " .
////                                    "اختر رقم:\n" .
////                                    "1. أسئلة عامة\n" .
////                                    "2. عميل \n" .
////                                    "3. مقدم خدمة \n" .
////                                    "4. التحدث إلى خدمة العملاء \n"
////                            );
////                        } else
//                            $chat_api->welcome($message['chatId'], $message['senderName'], true);
//
//

//
//                        return response()->json('salam', 200);
//                    }
//
//
//                    if ($quest_message == '#') {
//                        if ($chat_session->type == "customer_service")
//                            $chat_api->sendMessage(
//                                $message['chatId'],
//                                "شكرا لك " .
//                                    $message['senderName'] .
//                                    " على تواصلك معنا" .
//                                    "\n" .
//                                    "للإستفسار " .
//                                    "اختر رقم:\n" .
//                                    "1. أسئلة عامة\n" .
//                                    "2. عميل \n" .
//                                    "3. مقدم خدمة \n" .
//                                    "4. التحدث إلى خدمة العملاء \n"
//                            );
//                        else
//                            $chat_api->welcome($message['chatId'], $message['senderName'], false);
//
//                        $chat_session->type =  'notype';
//                        $chat_session->save();
//
//                        return;
//                    }
//
//
//
//
//                    $type = $chat_session->type; // session type: reset - notype,1-  all,2- provider, 3- user, 4- customer_service
//                    if ($type == 'customer_service') {
//                        return 0;
//                    }
//
//
//                    if (!is_numeric($quest_message)) {
//                        $chat_api->sendMessage($message['chatId'], 'أرسل رقما صحيحا من القائمة');
//                        return;
//                    }
//                    if ($type == 'notype') { // he has visited us befor;// but didnot select subject
//                        //1- general quest. 2- serv. prov. 3-customer  4- join me with support
//                        if ($quest_message > $quest_count + 1 ||  $quest_message < 1) {
//
//                            $chat_api->sendMessage($message['chatId'], 'أرسل رقما من القائمة');
//                            return;
//                        }
//
//                        if ($quest_message == 4) {
//                            $chat_session->type =  'customer_service';
//                            $chat_session->save();
//                            $chat_api->sendMessage($message['chatId'], "مرحبا بك " . $message['senderName'] .
//                                "\n" .
//                                " سوف يتواصل معك خدمة العملاء" .
//                                "\n" .
//                                " يمكنك في أي وقت الرجوع إلى القائمة الرئيسية بإرسال الرمز #");
//                            return response()->json('salam', 200);
//                        }
//
//                        $keys = array_keys(Faq::getTypes());
//                        $type = Faq::getTypes()[$keys[$quest_message - 1]]['key'];
//                        $title = Faq::getTypes()[$keys[$quest_message - 1]]['title'];
//
//                        $questions  = Faq::where('type', $type)->get();
//                        $question = '';
//                        $i = 1;
//                        foreach ($questions as $qust) {
//                            $question .= $i . '- ' . $qust->question . '<br>';
//                            $i++;
//                        }
//                        $question  = str_ireplace('<br>', "\n", $question);
//                        $question = strip_tags($question);
//                        $question .= "\n" . "للعودة للقائمة الرئيسية أرسل #";
//                        $chat_api->sendMessage($message['chatId'], $quest_message . '- ' . $title . "\n\n" . $question);
//
//                        $chat_session->type =  $type;
//                        $chat_session->save();
//                        return response()->json($question, 200);
//                    }
//
//                    //return response()->json('salam', 200);
//                    //$keys = array_keys(Faq::getTypes());
//                    //$type = Faq::getTypes()[$keys[$quest_message-1]]['key'];
//
//                    //get type from session
//
//                    $questions  = Faq::where('type', $type);
//                    if ($quest_message > $questions->count() ||  $quest_message < 1) {
//                        $chat_api->sendMessage(
//                            $message['chatId'],
//                            "أرسل رقما من القائمة" .
//                                "\n" . "أو قم بإرسال الرمز # للعودة للقائمة الرئيسية"
//                        );
//                        return;
//                    }
//                    $answer = $questions->skip($quest_message - 1)->first();
//                    //$chat_session->type =  'notype';
//                    //$chat_session->save();
//                    $chat_api->sendMessage($message['chatId'], $quest_message . '- ' . $answer->question . "\n\n" . preg_replace("/&nbsp;/", ' ', strip_tags(str_ireplace('<br>', '
//                    ', $answer->answer))));
//                    //$chat_api->welcome($message['chatId'], $message['senderName']);
//                    return response()->json($answer->answer, 200);
                }
            }
        }
    }
}
