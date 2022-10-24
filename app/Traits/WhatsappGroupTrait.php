<?php

namespace App\Traits;

use App\Http\Controllers\Admin\ChatAPI;

/**
 * Trait WhatsappGroupTrait
 * @package App\Traits
 */
trait WhatsappGroupTrait
{
    /**
     * @param string $name
     * @param bool $visibility // مخفي او ظاهر
     * @return mixed
     */
    public function createWhatsappGroup($order, $type)
    {

        if ($type == 'privateOrder') {
            if ($order->parent_order == 0) {
                $groupName = " تعميد خاص رقم" . "#" . $order->id ;
                $group_message =
                    "السلام عليكم و رحمة الله و بركاته \n" .
                    "تم تعميدكم في معاملة . كوم \n" .
                    "تعميد رقم  $order->id \n" .
                    "وتم ضمان المبلغ لحسابكم \n\n" .
                    "رقم صاحب الطلب " . $this->phone_filter($order->user_phone) . " \n" .
                    "رقم مقدم الخدمة " . $this->phone_filter($order->service_provider_phone) . " \n" .
                    "قيمة التعميد  $order->price ريال \n" .
                    "رسوم التعميد $order->fees ريال \n" .
                    "ضريبة القيمة المضافة $order->value_added_tax ريال \n" .
                    "اجمالي المبلغ  $order->total_amount ريال \n" .
                    "التعميد حتى تاريخ $order->deadline  \n" .
                    "التفاصيل : \n $order->details \n" .
                    "\n" .
                    "* يمكنك البدء وعند تأكيد الإنجاز نأمل إرسال حسابكم البنكي لتحويل المبلغ . \n";
            } else {

                $groupName = " تعميد خاص رقم" . "#" . $order->id . " @" . $order->parent_order;
                $group_message =
                    "السلام عليكم و رحمة الله و بركاته \n" .
                    "تم تعميدكم في معاملة . كوم \n" .
                    "تعميد رقم  $order->id \n" .
                    "وتم ضمان المبلغ لحسابكم \n\n" .
                    "رقم صاحب الطلب " . $this->phone_filter($order->app_customer_phone) . " \n" .
                    "رقم مقدم الخدمة " . $this->phone_filter($order->app_supervisor_phone) . " \n" .
                    "قيمة التعميد  $order->price ريال \n" .
                    "رسوم التعميد $order->fees ريال \n" .
                    "ضريبة القيمة المضافة $order->value_added_tax ريال \n" .
                    "اجمالي المبلغ  $order->total_amount ريال \n" .
                    "التعميد حتى تاريخ $order->deadline  \n" .
                    "التفاصيل : \n $order->details \n" .
                    "\n" .
                    "* يمكنك البدء وعند تأكيد الإنجاز نأمل إرسال حسابكم البنكي لتحويل المبلغ . \n";
            }
        } elseif ($type == 'publicOrder') {
            if ($order->parent_order == 0) {
                $groupName = " تعميد عام رقم" . "#" . $order->id;
                $group_message =
                    "السلام عليكم و رحمة الله و بركاته \n" .
                    "تم تعميدكم في معاملة . كوم \n" .
                    "تعميد رقم  $order->id \n" .
                    "وتم ضمان المبلغ لحسابكم \n\n" .
                    "رقم صاحب الطلب " . $this->phone_filter($order->app_customer_phone) . " \n" .
                    "رقم مقدم الخدمة " . $this->phone_filter($order->app_supervisor_phone) . " \n" .
                    "قيمة التعميد  $order->price ريال \n" .
                    "رسوم التعميد $order->fees ريال \n" .
                    "ضريبة القيمة المضافة $order->value_added_tax ريال \n" .
                    "اجمالي المبلغ  $order->total_amount ريال \n" .
                    "التعميد حتى تاريخ $order->deadline  \n" .
                    "التفاصيل : \n $order->details \n" .
                    "\n" .
                    "* يمكنك البدء وعند تأكيد الإنجاز نأمل إرسال حسابكم البنكي لتحويل المبلغ . \n";
            } else {

                $groupName = " تعميد " . $order->id . " @ " . $order->parent_order;
                $group_message =
                    "السلام عليكم و رحمة الله و بركاته \n" .
                    "تم تعميدكم في معاملة . كوم \n" .
                    "تعميد رقم  $order->id \n" .
                    "وتم ضمان المبلغ لحسابكم \n\n" .
                    "رقم صاحب الطلب " . $this->phone_filter($order->app_customer_phone) . " \n" .
                    "رقم مقدم الخدمة " . $this->phone_filter($order->app_supervisor_phone) . " \n" .
                    "قيمة التعميد  $order->price ريال \n" .
                    "رسوم التعميد $order->fees ريال \n" .
                    "ضريبة القيمة المضافة $order->value_added_tax ريال \n" .
                    "اجمالي المبلغ  $order->total_amount ريال \n" .
                    "التعميد حتى تاريخ $order->deadline  \n" .
                    "التفاصيل : \n $order->details \n" .
                    "\n" .
                    "* يمكنك البدء وعند تأكيد الإنجاز نأمل إرسال حسابكم البنكي لتحويل المبلغ . \n";
            }
        } elseif ($type == 'eservices') {

            if ($order->parent_order == 0) {
                $groupName = " خدمة الكترونية" . "#" . $order->id;

                $group_message =
                    "السلام عليكم و رحمة الله و بركاته \n" .
                    "تم تعميدكم في معاملة . كوم \n" .
                    "تعميد رقم  $order->id \n" .
                    "وتم ضمان المبلغ لحسابكم \n\n" .
                    "رقم صاحب الطلب " . $this->phone_filter($order->app_customer_phone) . " \n" .
                    "رقم مقدم الخدمة " . $this->phone_filter($order->app_supervisor_phone) . " \n" .
                    "قيمة التعميد  $order->price ريال \n" .
                    "رسوم التعميد $order->fees ريال \n" .
                    "ضريبة القيمة المضافة $order->value_added_tax ريال \n" .
                    "اجمالي المبلغ  $order->total_amount ريال \n" .
                    "التعميد حتى تاريخ $order->deadline  \n" .
                    "التفاصيل : \n $order->details \n" .
                    "\n" .
                    "* يمكنك البدء وعند تأكيد الإنجاز نأمل إرسال حسابكم البنكي لتحويل المبلغ . \n";
            } else {

                $groupName = " تعميد خدمة " . $order->id . " @ " . $order->parent_order;
                $group_message =
                    "السلام عليكم و رحمة الله و بركاته \n" .
                    "تم تعميدكم في معاملة . كوم \n" .
                    "تعميد رقم  $order->id \n" .
                    "وتم ضمان المبلغ لحسابكم \n\n" .
                    "رقم صاحب الطلب " . $this->phone_filter($order->app_customer_phone) . " \n" .
                    "رقم مقدم الخدمة " . $this->phone_filter($order->app_supervisor_phone) . " \n" .
                    "قيمة التعميد  $order->price ريال \n" .
                    "رسوم التعميد $order->fees ريال \n" .
                    "ضريبة القيمة المضافة $order->value_added_tax ريال \n" .
                    "اجمالي المبلغ  $order->total_amount ريال \n" .
                    "التعميد حتى تاريخ $order->deadline  \n" .
                    "التفاصيل : \n $order->details \n" .
                    "\n" .
                    "* يمكنك البدء وعند تأكيد الإنجاز نأمل إرسال حسابكم البنكي لتحويل المبلغ . \n";
            }
        }

        //get list of mobiles
        $jsonString = file_get_contents(base_path('resources/settings/chatapi.json'));
        $group_supervisors = json_decode($jsonString, true)['group_supervisors'];
        $no_spaces = preg_replace('/\s+/', ' ', $group_supervisors);

        //merge with clients phones
        $supervisors_phones = explode("rn", $no_spaces);
        $clients_phones = ['90' . substr($order->user_phone, 1), '90' . substr($order->service_provider_phone, 1)];
//        $group_phones = array_merge($clients_phones, $supervisors_phones);
//        dd($group_phones);

        $chat_api = new ChatAPI();
        $response =  $chat_api->group($groupName, $clients_phones, $group_message);
//        if ($response['created']) {
//            foreach ($supervisors_phones as $supervisor) {
//                $chat_api->assignSupervisorsTogroup($response['chatId'], $supervisor);
//            }
            //return 'group created';
//        }
//        $result = json_decode($response, true);

    }



    function phone_filter($phone)
    {

        $phone = trim($phone);
        $phone = str_replace(explode('-', '۰-۱-۲-۳-٤-٥-٦-٧-۸-۹'), range(0, 9), $phone);
        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('+', '', $phone);

        $phone = ltrim($phone, "0");
        $phone = ltrim($phone, "90");
        $phone = ltrim($phone, "0");

        $phone = "0" . $phone;
echo $phone;
        return $phone;
    }
}
