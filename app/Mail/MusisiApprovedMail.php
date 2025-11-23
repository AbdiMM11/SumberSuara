<?php

namespace App\Mail;

use App\Models\Musisi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MusisiApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Musisi $musisi;

    public function __construct(Musisi $musisi)
    {
        $this->musisi = $musisi->loadMissing('user');
    }

    public function build()
    {
        return $this->subject('Pendaftaran Musisi Sumber Suara Disetujui')
                    ->view('emails.musisi-approved');
    }
}
