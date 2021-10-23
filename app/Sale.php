<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'customer_id','product_id','type', 'note','status'
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
