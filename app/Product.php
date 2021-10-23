<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name','product_code','category_id','barcode','product_image_one','product_image_two','qty','product_price','retail_price','whole_price','message','status',
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function purchase()
    {
        return $this->hasMany(purchase::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }

    public function Sale()
    {
        return $this->hasMany(Sale::class);
        // note: we can also include comment model like: 'App\Models\Comment'
    }
    

    
}
