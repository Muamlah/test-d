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
class PrivateOrderNotify extends Notification
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
    public function via($notifiable): array
    {
        return  isset($notifiable->phone) ? ['database'] : [ 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('عزيزي المشرف ..')
                    ->line('يرجى التحقق من عملية الدفع')
                    ->line('طلب تعميد خاص رقم # '.$this->order->id.'')
                    ->action('لتحقق اضغط هنا', url('https://app.muamlah.com/admin/private_orders/'.$this->order->id.''))
                    ->line('ثم قم بتأكيد الطلب لمقدم الخدمة!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        $this->desktopNotifications('منصة معاملة','يوجد لديك طلب تعميد خاص رقم '.$this->order->id ,route('privateService.show',$this->order->id), [$notifiable->id],[],'private_public_orders');

        return [
            'order_id' => $this->order->id,
            'message' => 'يوجد لديك طلب تعميد خاص رقم '.$this->order->id.'',
            'link' => route('privateService.show',$this->order->id)
        ];
    }
}
