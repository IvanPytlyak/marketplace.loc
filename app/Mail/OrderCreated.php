<?php

namespace App\Mail;

use App\Models\Order;
use App\Classes\Basket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $order;
    // protected $basket;

    /**
     * Create a new message instance.
     */
    public function __construct($name, Order $order)
    {
        $this->name = $name;
        $this->order = $order;
        // $this->basket = $basket;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.order',
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


    public function build()
    {
        $fullSum = $this->order->getFullPrice();
        // return $this->view('mails.order', ['name' => $this->name, 'fullSum' => $fullSum, 'basket' => $this->basket]);
        return $this->view('mails.order', [
            'name' => $this->name,
            'fullSum' => $fullSum,
            'order' => $this->order
        ]);
    }
}
