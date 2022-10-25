<?php
namespace App\Listeners;

use App\Events\FirstAdCreated;
use App\Mail\Congratulation;
use Illuminate\Support\Facades\Mail;

class SendCongratulationEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FirstAdCreated $event)
    {
       Mail::to($event->user->email)->send(new Congratulation($event->ad));
    }
}
