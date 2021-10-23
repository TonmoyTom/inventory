<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name','status',
    ];

    public function product()
    {
        return $this->hasMany(product::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }
}
