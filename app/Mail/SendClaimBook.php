<?php

namespace App\Mail;

use App\ClaimBook;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendClaimBook extends Mailable
{
    use Queueable, SerializesModels;

    public $claimBook;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ClaimBook $claimBook)
    {
        $this->claimBook = $claimBook;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Se define plantilla y asunto para el correo
        return $this->view('emails.claimbook')
        ->subject('Libro de reclamaciones virtual: '.$this->claimBook->book_number.' - CASDEL');
    }
}
