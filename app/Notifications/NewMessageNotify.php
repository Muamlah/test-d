<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Traits\FirebaseTrait;

/**
 * Class Message
 * @package App\Notifications
 */
class NewMessageNotify extends Notification
{
    use Queueable;
    use FirebaseTrait;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @param $message
     * @return void
     */
    public function __construct($message)
    {
        //
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return   [ 'mail'];
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
                    ->line('تم إرسال رسالة جديدة من قسم خدمة العملاء')
                    ->line("الاسم: ".$this->message->name)
                    ->line("البريد الإلكتروني: ".$this->message->email)
                    ->line("الموضوع: ".$this->message->subject)
                    ->line("الرسالة: ".$this->message->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->desktopNotifications('منصة معاملة' , 'رسالة جديدة من خدمة العملاء', '', [$notifiable->id]);

        return [
            'message_id' => $this->message->id,
            'message' => 'رسالة جديدة من خدمة العملاء',

        ];
    }

   
}
