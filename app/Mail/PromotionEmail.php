<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromotionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title;
    public $date;
    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title, $date, $body)
    {
        $this->user = $user;
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.promotion');
    }
}
