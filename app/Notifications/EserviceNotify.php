<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Traits\FirebaseTrait;

class EserviceNotify extends Notification
{
    use Queueable;
    use FirebaseTrait;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return  [ 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('عزيزي المشرف ..')
            ->line('يرجى التحقق من عملية الدفع')
            ->line('طلب خدمة الكترونية # '.$this->order->id.'')
            ->action('لتحقق اضغط هنا', url('https://app.muamlah.com/admin/eservices_orders/'.$this->order->id.''))
            ->line('ثم قم بتأكيد الطلب لمقدم الخدمة!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->desktopNotifications('منصة معاملة' , 'يوجد لديك طلب خدمة الكترونية# '.$this->order->id, url('eservices_orders/myservice_details/'.$this->order->id), [$notifiable->id],[],'eservices_orders');

        return [
            'order_id' => $this->order->id,
            'message' => 'يوجد لديك طلب خدمة الكترونية' . "#".$this->order->id,
            'link' => url('eservices_orders/myservice_details/'.$this->order->id)

        ];
    }
}
