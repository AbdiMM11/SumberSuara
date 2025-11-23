<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AudiensWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public int $umur;
    public ?string $jenisKelaminLabel;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, int $umur, ?string $jenisKelaminLabel = null)
    {
        $this->user = $user;
        $this->umur = $umur;
        $this->jenisKelaminLabel = $jenisKelaminLabel;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Selamat Datang di Sumber Suara!')
                    ->view('emails.audiens-welcome');
    }
}
