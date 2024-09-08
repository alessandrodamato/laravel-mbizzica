<?php

namespace App\Functions;

use App\Models\Paste;
use Illuminate\Support\Carbon;

class WriteToFile
{
  public static function write(Paste $paste)
  {
    $filePath = storage_path('app/data/pastes.txt');

    $data = [
      'ID: ' . $paste->id,
      'Title: ' . $paste->title,
      'Content: ' . $paste->content,
      'Expiration Date: ' . ($paste->expiration_date ? Carbon::parse($paste->expiration_date)->format('Y-m-d') : null),
      'Visibility: ' . $paste->visibility,
      'File: ' . $paste->file,
      'User ID: ' . $paste->user_id
    ];

    $dataString = implode(PHP_EOL, $data) . PHP_EOL . str_repeat('-', 20) . PHP_EOL;

    if (file_put_contents($filePath, $dataString, FILE_APPEND) === false) {
      throw new \Exception("Errore durante la scrittura del file: $filePath");
    }
  }
}
