<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdmins extends Notification
{
    use Queueable;
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message1,$message2,$link,$title = 'Muamlah')
    {
        $this->message1     = $message1;
        $this->message2     = $message2;
        $this->link         = $link;
        $this->title        = $title;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
        // return  isset($notifiable->phone) ? ['database'] : [ 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($this->message1,$this->message2,$this->link);
        return (new MailMessage)
            ->subject($this->title)
            ->line('عزيزي المشرف ..')
            ->line($this->message1)
            ->line($this->message2)
            ->action('لتحقق اضغط هنا', url($this->link))
            ->line('شكراً لك');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // return [
        //     'order_id' => 'asd',
        //     'message' => 'تم إلغاء هذه الخدمة من قِبل العميل',
        //     // 'link' => url('eservices_orders/show/'.$this->order->id)
        //     'link' => ''
        // ];
        
    }
}
