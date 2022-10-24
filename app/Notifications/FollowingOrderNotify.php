<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Traits\FirebaseTrait;

class FollowingOrderNotify extends Notification
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
        
        if($this->status == 'order_added_to_existing_provider'){
            $this->desktopNotifications('منصة معاملة' , 'تم إضافة التعميد إلى مزود خدمة جديد', url($this->link), [$notifiable->id]);

            return [
                'order_id' => $this->order->id,
                'message' => 'تم إضافة التعميد إلى مزود خدمة جديد',
                'link' => url($this->link)
            ];
        }elseif($this->status == 'report'){
            $this->desktopNotifications('منصة معاملة' , 'حالة إبلاغ', url($this->link), [$notifiable->id],[],'private_public_orders');

            return [
                'order_id' => $this->order->id,
                'message' => 'حالة إبلاغ',
                'link' => url($this->link)
            ];
        }
        
    }
}
