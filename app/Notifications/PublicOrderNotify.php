<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Traits\FirebaseTrait;

/**
 * Class PrivateOrder
 * @package App\Notifications
 */
class PublicOrderNotify extends Notification
{
    use Queueable, FirebaseTrait;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @param $order
     * @return void
     */
    public function __construct($order)
    {
        //
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
            ->line('خدمة الاكترونية رقم # '.$this->order->id.'')
            ->action('لتحقق اضغط هنا', url('https://app.muamlah.com/admin/public_orders/'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        $this->desktopNotifications('منصة معاملة', 'تم اضافة عرض جديد على الخدمة رقم# '.$this->order->id, route('publicOrders.offers.show',$this->order->id), [$notifiable->id],[],'private_public_orders');

        return [
            'order_id' => $this->order->id,
            'message' => 'تم اضافة عرض جديد على الخدمة رقم# '.$this->order->id ,
            'link' => route('publicOrders.offers.show',$this->order->id),

        ];
    }
}
