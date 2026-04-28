<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $guarded = ['id'];

    public function item() { return $this->belongsTo(Item::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
}
