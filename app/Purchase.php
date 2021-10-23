<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $fillable = [
        'supplier_id','product_id','type', 'note','status'
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    // public function getTotalPrice() {
    //     return $this->supplier->sum(function($price) {
    //       return $price->blance - $price->price;
    //     });
    //   }
    
  
}
