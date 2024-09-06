<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;

    protected $fillable = [
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

}
