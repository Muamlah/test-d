<?php

namespace App\Notifications;

use App\Traits\FirebaseTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EserviceAcceptNotify extends Notification
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
        return  isset($notifiable->phone) ? ['database'] : [ 'mail'];
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
            ->line('طلب خدمة الكترونية رقم # '.$this->order->id.'')
            ->action('لتحقق اضغط هنا', url('https://app.muamlah.com/admin/eservices_orders/'.$this->order->id.'/edit'))
            ->line('الطلب حاليا قيد التنفيذ!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->desktopNotifications('منصة معاملة' , 'تم قبول طلبك للخدمة الالكترونية# '.$this->order->id, url('eservices_orders/show/'.$this->order->id), [$notifiable->id],[],'eservices_orders');

        return [
            'order_id' => $this->order->id,
            'message' => 'تم قبول طلبك للخدمة الالكترونية',
            'link' => url('eservices_orders/show/'.$this->order->id)

        ];
    }
}
