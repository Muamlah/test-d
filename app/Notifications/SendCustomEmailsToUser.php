<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;

class SendCustomEmailsToUser extends Mailable
{
    use Queueable,SerializesModels;
    // private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $title;
    public $message1;
    public $message2;
    public $message3;


    public function __construct(Array $info)
    {
        $this->title        = $info['title'];
        $this->message1     = $info['message1'];
        $this->message2     = $info['message2'];
        $this->message3     = $info['message3'];

    }

    public function build()
    {
        return $this->view('emails.custom.html.layout_user')
        ->subject($this->message1)
        ->with([
            'title'         => $this->title,
            'message1'      => $this->message1,
            'message2'      => $this->message2,
            'message3'      => $this->message3,
        ]);

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader(
                'Custom-Header', ''
            );
        });

    }
}
