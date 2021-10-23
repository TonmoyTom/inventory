<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'product_id','colorname',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }

    public function attribute()
    {
        return $this->hasMany(product::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }

}
