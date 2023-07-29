<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope   //тема письма
    {
        return new Envelope(
            // subject: 'Mail Message',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content // view для письма
    {
        return new Content(
            view: 'mails.send',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }


    // Новый
    public function build()
    {
        // dd($this->message);
        return $this->view('mails.send')
            ->subject($this->subject)
            ->with(
                'mailMessage',
                $this->message
            );
    }
}
