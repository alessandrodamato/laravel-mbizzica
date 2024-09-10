<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewComment extends Mailable
{
  use Queueable, SerializesModels;

  public $comment;

  public function __construct($comment)
  {
    $this->comment = $comment;
  }

  public function build()
  {
    return $this->view('emails.new_comment')
    ->subject('Nuovo Commento sul tuo paste')
    ->with(['comment' => $this->comment]);
  }
}
