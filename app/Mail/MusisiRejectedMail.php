<?php

namespace App\Mail;

use App\Models\Musisi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MusisiRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Musisi $musisi;

    public function __construct(Musisi $musisi)
    {
        $this->musisi = $musisi->loadMissing('user');
    }

    public function build()
    {
        return $this->subject('Pendaftaran Musisi Sumber Suara Ditolak')
                    ->view('emails.musisi-rejected');
    }
}
