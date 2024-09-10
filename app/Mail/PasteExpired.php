<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasteExpired extends Mailable
{
  use Queueable, SerializesModels;

  public $paste;

  public function __construct($paste)
  {
    $this->paste = $paste;
  }

  public function build()
  {
    return $this->view('emails.paste_expired')
    ->subject('Il tuo paste è scaduto')
    ->with(['paste' => $this->paste]);
  }
}
