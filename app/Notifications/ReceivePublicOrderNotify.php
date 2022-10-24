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
class ReceivePublicOrderNotify extends Notification
{
    use Queueable;
    use FirebaseTrait;

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

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->desktopNotifications('منصة معاملة','تم تسليم الطلب من مزود الخدمة رقم الطلب# '.$this->order->id , route('publicOrders.showDetails',$this->order->id), [$notifiable->id],[],'private_public_orders');

        return [
            'order_id' => $this->order->id,
            'message' => 'تم تسليم الطلب من مزود الخدمة رقم الطلب# '.$this->order->id ,
            'link' => route('publicOrders.showDetails',$this->order->id)

        ];
    }


}
