<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasteExpired;
use App\Models\Paste;
use Carbon\Carbon;

class SendExpiredPastesEmails extends Command
{
  protected $signature = 'pastes:send-expired-emails';
  protected $description = 'Invia email per i paste scaduti';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $expiredPastes = Paste::whereNotNull('expiration_date')
      ->where('expiration_date', '<', Carbon::now())
      ->take(5) // solo 5 perché mailtrap con il piano gratuito ne fa mandare massimo 5 per volta
      ->get();

    foreach ($expiredPastes as $paste) {
      if ($paste->user && $paste->user->email) {
        Mail::to($paste->user->email)->send(new PasteExpired($paste));
      }
    }

    $this->info('Email inviate con successo ai paste scaduti!');
  }
}
