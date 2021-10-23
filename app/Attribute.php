<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'product_id','size','color','price','stock','sku','status'
    ];
    
    public function product()
    {
        return $this->belongsTo(product::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }

    public function colors()
    {
        return $this->belongsTo(Color::class);
    }
}
