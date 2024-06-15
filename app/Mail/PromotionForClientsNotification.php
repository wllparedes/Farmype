<?php

namespace App\Mail;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromotionForClientsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $promotion;
    public $client;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Promotion $promotion, User $client)
    {
        $this->promotion = $promotion->load('user', 'products', 'file');
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('(no-reply) Nueva promoción')
            ->markdown('mail.promotion-for-clients-notification');
    }
}
