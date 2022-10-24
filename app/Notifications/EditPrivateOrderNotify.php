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
class EditPrivateOrderNotify extends Notification
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
     * @return array
     */
    public function via(): array
    {
        return   ['database'] ;
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->desktopNotifications('منصة معاملة' , 'تم تعديل الطلب الخاص رقم '.$this->order->id,  route('privateService.show',$this->order->id), [$notifiable->id],[],'private_public_orders');

        return [
            'order_id' => $this->order->id,
            'message' => 'تم تعديل الطلب الخاص رقم '.$this->order->id.'',
            'link' => route('privateService.show',$this->order->id)
        ];
    }
}
