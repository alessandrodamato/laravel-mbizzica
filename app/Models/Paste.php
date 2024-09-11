<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'content',
    'title',
    'visibility',
    'expiration_date',
    'password',
    'file',
  ];

  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function votes()
  {
    return $this->hasMany(Vote::class);
  }
}
