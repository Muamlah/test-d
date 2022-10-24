<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Traits\FirebaseTrait;

class ChangeStatusNotify extends Notification
{
    use Queueable;
    use FirebaseTrait;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order,$status,$link)
    {
        $this->order    = $order;
        $this->status   = $status;
        $this->link     = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return  isset($notifiable->phone) ? ['database'] : [ 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     if($this->status == 'canceled'){
    //         return (new MailMessage)
    //             ->line('عزيزي المشرف ..')
    //             ->line('تم إلغاء هذه الخدمة من قِبل العميل')
    //             ->line('طلب خدمة الكترونية رقم # '.$this->order->id.'')
    //             // ->action('لتحقق اضغط هنا', url('https://app.muamlah.com/admin/eservices_orders/'.$this->order->id.'/edit'))
    //             ->line('الطلب حاليا تم إلغائه!');
    //     }
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        if($this->status == '6'){
        $this->desktopNotifications('منصة معاملة' , 'تم إلغاء هذه الخدمة من قِبل العميل',  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->id,
                'message' => 'تم إلغاء هذه الخدمة من قِبل العميل',
                // 'link' => url('eservices_orders/show/'.$this->order->id)
                'link' => url($this->link)
            ];
        }elseif( $this->status == '5'){
        $this->desktopNotifications('منصة معاملة' , 'تم تأكيد استلام الطلب من قِبل العميل',  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->id,
                'message' => 'تم تأكيد استلام الطلب من قِبل العميل',
                'link' => url($this->link)
            ];
        }elseif( $this->status == '4'){
        $this->desktopNotifications('منصة معاملة' , 'تم تسليم الخدمة من قِبل مزود الخدمة',  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->id,
                'message' => 'تم تسليم الخدمة من قِبل مزود الخدمة',
                'link' => url($this->link)
            ];
        }elseif($this->status == '7'){
        $this->desktopNotifications('منصة معاملة' , 'تم تأكيد إلغاء هذه الخدمة من قِبل مزود الخدمة',  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->id,
                'message' => 'تم تأكيد إلغاء هذه الخدمة من قِبل مزود الخدمة',
                'link' => url($this->link)
            ];
        }elseif($this->status == '8'){
        $this->desktopNotifications('منصة معاملة' , 'لقد تم تقديم بلاغ لهذه الخدمة',  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->id,
                'message' => 'لقد تم تقديم بلاغ لهذه الخدمة',
                'link' => url($this->link)
            ];
        }elseif($this->status == '30'){
            $this->desktopNotifications('منصة معاملة' , 'تمت الموافقة على طلب التعميد الخاص رقم '.$this->order->master_order.' من طرف مزود الخدمة',  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->master_order,
                'message' => "تمت الموافقة على طلب التعميد الخاص رقم ".$this->order->master_order." من طرف مزود الخدمة ",
                'link' => url($this->link)
            ];
        }elseif($this->status == '60'){
            $this->desktopNotifications('منصة معاملة' , "تم الغاء  طلب التعميد خاص رقم ".$this->order->master_order." من طرف مقدم الخدمة ",  url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->master_order,
                'message' => "تم الغاء  طلب التعميد خاص رقم ".$this->order->master_order." من طرف مقدم الخدمة ",
                'link' => url($this->link)
            ];
        }
        elseif($this->status == '80'){
            $this->desktopNotifications('منصة معاملة' , "تم تقديم بلاغ لطلب تعميد خاص رقم ".$this->order->master_order." من طرف مزود الخدمة",  url($this->link), [$notifiable->id]);
            return [
                'order_id' => $this->order->master_order,
                'message' => "تم تقديم بلاغ لطلب تعميد خاص رقم ".$this->order->master_order." من طرف مزود الخدمة",
                'link' => url($this->link)
            ];
        }elseif($this->status == '70'){
            $this->desktopNotifications('منصة معاملة' , "تم تأكيد إلغاء طلب التعميد الخاص رقم ".$this->order->master_order." من طرف مزود الخدمة",  url($this->link), [$notifiable->id]);
            return [
                'order_id' => $this->order->master_order,
                'message' => "تم تأكيد إلغاء طلب التعميد الخاص رقم ".$this->order->master_order." من طرف مزود الخدمة",
                'link' => url($this->link)
            ];
        }

    }
}
