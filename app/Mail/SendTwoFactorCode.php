<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTwoFactorCode extends Mailable
{
  use Queueable, SerializesModels;

  public $two_factor_code;
  public $two_factor_expires_at;

  public function __construct($two_factor_code, $two_factor_expires_at)
  {
    $this->two_factor_code = $two_factor_code;
    $this->two_factor_expires_at = $two_factor_expires_at;
  }

  public function build()
  {
    return $this->view('emails.two_factor_code')
      ->subject('Codice di verifica a due fattori')
      ->with(['two_factor_code' => $this->two_factor_code, 'two_factor_expires_at' => $this->two_factor_expires_at]);
  }
}
