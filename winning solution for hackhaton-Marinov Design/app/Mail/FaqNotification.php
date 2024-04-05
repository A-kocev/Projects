<?php

namespace App\Mail;

use App\Models\Faq;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FaqNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $faq;

    /**
     * Create a new message instance.
     *
     * @param Faq $faq
     */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function build()
    {
        return $this->subject('FAQ Notification')
                    ->markdown('mails.faq-notification');
    }
}
