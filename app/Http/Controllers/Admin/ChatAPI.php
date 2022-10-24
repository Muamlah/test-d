<?php

namespace App\Http\Controllers\Admin;

use App\Models\PrivateOrder;
use App\Traits\WhatsappGroupTrait;
use Arr;
use GuzzleHttp\Client as HttpClient;


/**
 *
 */
class ChatAPI extends Controller
{
use WhatsappGroupTrait;
    protected $token = null;
    protected $api_url = null;

    /**
     * @param null $token
     * @param null $api_url
     */
    public function __construct($token = null, $api_url = null)
    {
//        $jsonString = file_get_contents(base_path('resources/settings/chatapi.json'));
//        $data = json_decode($jsonString, true);
//        $this->api_url      = 'https://api.chat-api.com/instance' . $data['instance'];
//        $this->token        = $data['token'];
    }

    /**
     * Get HttpClient. for sending request to chat-api
     *
     * @return HttpClient
     */
    protected function httpClient()
    {
        return new HttpClient([

            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ]
        ]);
    }
    // to form uri with token and request parameters
    private function uriWithToken($uri)
    {
        return rtrim($this->api_url, '/') . $uri . '?token=' . $this->token;
    }
    /**
     * @param $phone integer A phone number starting with the country code. You do not need to add your number. like 967775521104 in Yemen.

     * @param $message
     * @return array
     */
    public function sendMessage($phone, $message)
    {
        $data = [
            'body' => $message
        ];

        if (strpos($phone, '@') === false)
            $data['phone'] = preg_replace('/[^0-9]/', '', $phone);
        else
            $data['chatId'] = $phone;

        $res = $this->httpClient()->post($this->uriWithToken('/sendMessage'), ['json' => $data]);


        return json_decode($res->getBody()->getContents(), true);
    }

    public function getGroupsList()
    {

        $response = $this->httpClient()->get($this->uriWithToken('/dialogs'));
        $dialogs = json_decode($response->getBody(), true);

        $dialogs = $dialogs['dialogs'];


        $filteredArray = Arr::where($dialogs, function ($value, $key) {
            return strpos($value['id'], '@g') !== false;
        });

        return $filteredArray;
    }
    public function getGroupInfo($phone, $message)
    {
        $data = [
            'body' => $message
        ];

        if (strpos($phone, '@') === false)
            $data['phone'] = preg_replace('/[^0-9]/', '', $phone);
        else
            $data['chatId'] = $phone;

        $res = $this->httpClient()->get($this->uriWithToken('/dialog'));


        return json_decode($res->getBody()->getContents(), true);
    }

    /**
     * Send a file (user's Guide)to a new or existing chat
     * Only one of two parameters is needed to determine the destination - chatId or phone.
     *
     * @param string $phone Send the user phone or chatId
     * @param string $file You can send a file url, full path or file contents
     * @param string|null $filename The file named received by the user
     * @param string|null $mimetype The file mime type
     * @return array
     */
    /**
     * Creates a group and sends the message to the created group. If the host is iPhone, then the presence of all in the contact list is required.
     *
     * The group will be added to the queue for sending and sooner or later it will be created, even if the phone is disconnected from the Internet or the authorization is not passed.
     * chatId parameter will be returned if group was created on your phone within 20 seconds.
     * @param string $groupName Group name, string, mandatory.
     * @param array $phones An array of phones starting with the country code. You do not need to add your number.
    USA example: ['17472822486'].
     * @param string $message Message text
     * @return array
     */
    public function group($groupName, $phones, $message)
    {

        if (empty($phones)) {
            return;
        }

        $data = [
            'messageText' => $message,
            'phones' => $phones,
            'groupName' => $groupName,
            'preview96' => "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wgARCAFAAUADASIAAhEBAxEB/8QAGgABAAMBAQEAAAAAAAAAAAAAAAMEBQECBv/EABkBAQADAQEAAAAAAAAAAAAAAAABAwQCBf/aAAwDAQACEAMQAAAC3wK9XORbq8SAAAAAAAAAAAAAA7YrDZtfOXYaznUs63hICQAAAAABY0jJk2UMSH6HwYK/QkAAAAAAlaFHfq5Sm5mjRkj01gAAAAALlfcOiAACraHzzQz5AAAAJWhR26Yrh575yx6NADvdgq2p0IobYxYPocqVMGnehmgAAAB4wfocQhEgAErQo7dMVwAGSPUzAaV/x7gAA50YPi7SluyVrMAAAAGNs4RGJAJWhR26YrgAAMkepmA+hRSwAAAzs+3Ule0/n9qEwAAAIMWxXkAlaFHbpiuAAAAyR6mYC9p/PaZeEAEfcci4SSRjbm+fuw01aUkQ1y7l145AJWhR26YrgAAAAMkepmAAsWs0akNEevIACYhadsx5tVDJh3B883aks2WS5R26YrgAAAAAMkepmHTk926U55UI/MwoUdHNl4muXytZIAAAI0FHYY7gAAAAAAMk76mbuwngAAqW8I8a0OgAAAAI0FHYY7gAAAB1HEsXcBx0Bk6uVuepmlEAAI8PdxpbfSAAACJDR2GO4AAAAdQsd97akUqzmnyzWxWhX3k949TNIjEiMSIxJ58ixJTFxTFxTFyapfz9hjuAAAAHqYWee9tIWwAg91s/QZLskepmAAAAAATr+fsMdwAAAA9TCy9baQtgDkXa+foMlwGSPUzAAAAAJ1/P2GO5N2XVVBFdghCM1oA99Qsu7aQsgBAhzdhltAAyR6mYAAABOv5+wx3J4rOmr0NXAEMFyLP3AS5++WOttQdwArosvYZrQAAMkepmAAATr+fsMdwD15TFv1TtbafQtgDx7IBIcgrPGWwM9gAAAGS7z1MwACdez99GO4AAB3iYte6dnZV7F3IA5DlZ5yWBRYAAAABnRX6HqZgE69n76MdwAAAADvCLEtKzsqkPN3PK/OY7Qp7AAAAAefXe+Z8L6Kj6FGVOvUd9GO4AAAAAAACaLjvkOOgAAAAAOWI7WukNHMEN3xR1VSeM1nBx0AAAAAAAAAAAAAPffPiSWTRWGjn/2gAMAwEAAgADAAAAIfJ0wwwwwwwwwwwwww01/Jwwwwwwwxz3zwwwwww3gCwwwwwwyXffbYwwww3vuYw1f/YQ1ffffewww3vvPAw9ffbQ3ffffaww3PvPPAw1fffS1/ffeYQ3PvPPPAw3ffdww8+cSQ3PvPPPPAww0cQwx3b/AMlT7zzzzzwMME10lF3330X7zzzzzzwef339/wB999k+88887588R999pd9998+88887wiV8TzzzjTzzZ+88884J88X8DDDDDDDbc8888+788z+8DDDDDDZeuC888688a888DDDDDZc188cww84H8888DDDDZc89p88s8+c88888DDDdc8889A886d888884rDdc88888vp4s888888t7dc8888888+W888888878h5088888888888849D8/9oADAMBAAIAAwAAABDjvz77777777777777zvS/7777777BPfz777777lbz777776YEEFPT7777mTn76ZFNb4MEEEHb777mT2374MEFHwsEEEFL77uT33374EEEHQ8EEEF77uT333374QEEj768sO77uT333337744777qoMPbPz33333377VOPqGMEEHDT3333333okEFAIEEEEFz3332HX324EEFQEEEFnz3330ZZ0f244444wwzFz3332snzxz37777777l/33323LzzXz3777777vxTfX3QXzzT33377777t8bzwgnzzgD33337777t/wB6b88Q8+6999992++/f999wG88Ae999999c+/f99999Z6HK999999wlvf99999994K9999999z81ma99999999999990bc/8QAMBEAAQIDBQcEAgMBAQAAAAAAAQIDAAURBCExUbEQEiAiQXHhEzBh0TKhI4HBkfD/2gAIAQIBAT8AhKc4AAw98gGFJy2JT19gqAjfMBecAg4cc2mws4LTR59PMSa3KeSWXDUjA5jxCRQcajS7gBpANRXhm02FnBaaPPp5hSio1OMWB0tWhCxn+jcdqlUgkmN4wlVbjsJqeFGXBNpsLOC00efT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",
            'avatar640' => "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wgARCAFAAUADASIAAhEBAxEB/8QAGgABAAMBAQEAAAAAAAAAAAAAAAMEBQECBv/EABkBAQADAQEAAAAAAAAAAAAAAAABAwQCBf/aAAwDAQACEAMQAAAC3wK9XORbq8SAAAAAAAAAAAAAA7YrDZtfOXYaznUs63hICQAAAAABY0jJk2UMSH6HwYK/QkAAAAAAlaFHfq5Sm5mjRkj01gAAAAALlfcOiAACraHzzQz5AAAAJWhR26Yrh575yx6NADvdgq2p0IobYxYPocqVMGnehmgAAAB4wfocQhEgAErQo7dMVwAGSPUzAaV/x7gAA50YPi7SluyVrMAAAAGNs4RGJAJWhR26YrgAAMkepmA+hRSwAAAzs+3Ule0/n9qEwAAAIMWxXkAlaFHbpiuAAAAyR6mYC9p/PaZeEAEfcci4SSRjbm+fuw01aUkQ1y7l145AJWhR26YrgAAAAMkepmAAsWs0akNEevIACYhadsx5tVDJh3B883aks2WS5R26YrgAAAAAMkepmHTk926U55UI/MwoUdHNl4muXytZIAAAI0FHYY7gAAAAAAMk76mbuwngAAqW8I8a0OgAAAAI0FHYY7gAAAB1HEsXcBx0Bk6uVuepmlEAAI8PdxpbfSAAACJDR2GO4AAAAdQsd97akUqzmnyzWxWhX3k949TNIjEiMSIxJ58ixJTFxTFxTFyapfz9hjuAAAAHqYWee9tIWwAg91s/QZLskepmAAAAAATr+fsMdwAAAA9TCy9baQtgDkXa+foMlwGSPUzAAAAAJ1/P2GO5N2XVVBFdghCM1oA99Qsu7aQsgBAhzdhltAAyR6mYAAABOv5+wx3J4rOmr0NXAEMFyLP3AS5++WOttQdwArosvYZrQAAMkepmAAATr+fsMdwD15TFv1TtbafQtgDx7IBIcgrPGWwM9gAAAGS7z1MwACdez99GO4AAB3iYte6dnZV7F3IA5DlZ5yWBRYAAAABnRX6HqZgE69n76MdwAAAADvCLEtKzsqkPN3PK/OY7Qp7AAAAAefXe+Z8L6Kj6FGVOvUd9GO4AAAAAAACaLjvkOOgAAAAAOWI7WukNHMEN3xR1VSeM1nBx0AAAAAAAAAAAAAPffPiSWTRWGjn/2gAMAwEAAgADAAAAIfJ0wwwwwwwwwwwwww01/Jwwwwwwwxz3zwwwwww3gCwwwwwwyXffbYwwww3vuYw1f/YQ1ffffewww3vvPAw9ffbQ3ffffaww3PvPPAw1fffS1/ffeYQ3PvPPPAw3ffdww8+cSQ3PvPPPPAww0cQwx3b/AMlT7zzzzzwMME10lF3330X7zzzzzzwef339/wB999k+88887588R999pd9998+88887wiV8TzzzjTzzZ+88884J88X8DDDDDDDbc8888+788z+8DDDDDDZeuC888688a888DDDDDZc188cww84H8888DDDDZc89p88s8+c88888DDDdc8889A886d888884rDdc88888vp4s888888t7dc8888888+W888888878h5088888888888849D8/9oADAMBAAIAAwAAABDjvz77777777777777zvS/7777777BPfz777777lbz777776YEEFPT7777mTn76ZFNb4MEEEHb777mT2374MEFHwsEEEFL77uT33374EEEHQ8EEEF77uT333374QEEj768sO77uT333337744777qoMPbPz33333377VOPqGMEEHDT3333333okEFAIEEEEFz3332HX324EEFQEEEFnz3330ZZ0f244444wwzFz3332snzxz37777777l/33323LzzXz3777777vxTfX3QXzzT33377777t8bzwgnzzgD33337777t/wB6b88Q8+6999992++/f999wG88Ae999999c+/f99999Z6HK999999wlvf99999994K9999999z81ma99999999999990bc/8QAMBEAAQIDBQcEAgMBAQAAAAAAAQIDAAURBCExUbEQEiAiQXHhEzBh0TKhI4HBkfD/2gAIAQIBAT8AhKc4AAw98gGFJy2JT19gqAjfMBecAg4cc2mws4LTR59PMSa3KeSWXDUjA5jxCRQcajS7gBpANRXhm02FnBaaPPp5hSio1OMWB0tWhCxn+jcdqlUgkmN4wlVbjsJqeFGXBNpsLOC00efT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",

        ];



        $res = $this->httpClient()->post($this->uriWithToken('/group'), ['json' => $data]);

        return json_decode($res->getBody()->getContents(), true);
    }

    public function assignSupervisorsTogroup($groupID, $supervisor)
    {

        $data = [
            'groupId' => $groupID,
            'participantPhone' => $supervisor,
        ];

       $res = $this->httpClient()->post($this->uriWithToken('/promoteGroupParticipant'), ['json' => $data]);

        return json_decode($res->getBody()->getContents(), true);
    }



    public function sendFile($phone, $file, $filename = null, $mimetype = null)
    {


        $data = [
            'phone' => $phone, // Receivers phone > we use phone instead of using chatID
        ];

        if (filter_var($file, FILTER_VALIDATE_URL) !== FALSE) {


            $data['body'] = $file;

            if ($filename === null) {
                $filename = pathinfo($file, PATHINFO_BASENAME);
            }
        } else {
            if (file_exists($file)) {
                if ($filename === null) {
                    $filename = pathinfo($file, PATHINFO_BASENAME);
                }

                if ($mimetype === null) {
                    $mimetype = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
                }

                $file = file_get_contents($file);
            }

            $data['body'] = 'data:' . $mimetype . ';base64,' . base64_encode($file);
        }

        $data['filename'] = $filename;


        $res = $this->httpClient()->post($this->uriWithToken('/sendFile'), ['json' => $data]);

        return json_decode($res->getBody()->getContents(), true);
    }

    /**
     * get message archive by chatid(phone)
     * @param int $byQuantity  The lastMessageNumber parameter from the last response
     * @param integer $byLastMessageNumber  Displays the last 100 messages. If this parameter is passed, then lastMessageNumber is ignored.
     * @return array
     */
    public function messages($byQuantity = 100, $byLastMessageNumber = null)
    {
        $data = [
            'token' => $this->token
        ];

        if ($byQuantity > 0) {
            $data['last'] = $byQuantity;
        } else {
            $data['lastMessageNumber'] = $byLastMessageNumber;
        }

        $res = $this->httpClient()->get($this->api_url . '/messages?' . http_build_query($data));

        return json_decode($res->getBody()->getContents(), true);
    }

    /**
     * Sets the URL for receiving webhook notifications of new messages and message delivery events (ack).
     * @param string $webhook_url Http or https URL for receiving notifications. For testing, we recommend using requestb.in.
     * @param bool $set
     * @return array
     */
    public function setWebhook($webhook_url, $set = true)
    {

        $data = [
            'set' => true,
            'webhookUrl' => $webhook_url
        ];



        //return $this->uriWithToken('/webhook');
        $res = $this->httpClient()->post($this->uriWithToken('/webhook'), ['json' => $data]);

        return json_decode($res->getBody()->getContents(), true);
    }
    public function senduserguide($phone)
    {
        return $this->sendFile($phone, base_path('resources/userguid.pdf')); // the file must be exist in resources folder!
    }
    public function welcome($chatId, $senderName, $welcome = true)
    {
        $welcome_msg = "مرحباً بكم معكم مرتاح🙂
أقدم لكم خدمة إدارة الطلب بشكل تلقائي
";
        $welcomeString = ($welcome) ? $welcome_msg : "";

        $this->sendMessage(
            $chatId,
            $welcomeString .
                "برجاء كتابة رقم الخدمة المطلوبة " .
                "اختر رقم:\n" .
                "1 - تم الإنجاز\n" .
                "2 - برجاء الغاء الطلب \n" .
                "3 - يوجد مشكلة بالتعميد \n".
                "# - لعرض الخيارات في اي وقت \n"


        );
    }
    public function test()
    {
        $data= PrivateOrder::find(100262);
        $this->createWhatsappGroup($data,'privateOrder');
    }
}
