<?php
namespace App\Mail;
use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferAccepted extends Mailable {
    use Queueable, SerializesModels;
    public $ad;

    public function __construct(Ad $ad){
        $this->ad = $ad;
    }

    public function build() {
        return $this->from('no-reply@cifopop.com')
                ->subject('Oferta aceptada')
                ->view('emails.accept');
    }
}
