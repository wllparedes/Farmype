<?php

namespace App\Listeners\Company;

use App\Events\Company\PromotionForClients;
use App\Mail\PromotionForClientsNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPromotionForClientsNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Company\PromotionForClients  $event
     * @return void
     */
    public function handle(PromotionForClients $event)
    {

        $promotion = $event->promotion;

        $clients = User::where('role', 'clients')->get();

        foreach ($clients as $client) {
            Mail::to($client->email)->send(new PromotionForClientsNotification($promotion, $client));
        }
    }
}
