<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class message extends Model
{
    protected $fillable = [
        'user_id', 'messager_id','reply_id', 'subject','message',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
