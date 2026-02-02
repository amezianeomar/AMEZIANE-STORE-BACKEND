<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Les données du formulaire

    public function __construct($data)
    {
        $this->data = $data; // On charge la cargaison [cite: 427-430]
    }

    public function build()
    {
        return $this->view('emails.transmission_content') // La vue du mail
                    ->subject('⚡ UPLINK RECEIVED: ' . $this->data['subject']);
    }
}