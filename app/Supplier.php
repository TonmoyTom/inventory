<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','email','mobile', 'tax','balance','address'
    ];

    public function purchase()
    {
        return $this->hasMany(purchase::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }
}
