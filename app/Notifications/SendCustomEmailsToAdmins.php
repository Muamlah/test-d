<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;

class SendCustomEmailsToAdmins extends Mailable
{
    use Queueable,SerializesModels;
    // private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $message1;
    public $message2;

    public function __construct(Array $info)
    {
        $this->message1     = $info['message1'];
        $this->message2     = $info['message2'];

    }

    public function build()
    {
        return $this->view('emails.custom.html.layout')
        ->subject($this->message1)
        ->with([
            'message1'      => $this->message1,
            'message2'      => $this->message2,
        ]);

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader(
                'Custom-Header', 'طلب سحب رصيد'
            );
        });

    }
}
