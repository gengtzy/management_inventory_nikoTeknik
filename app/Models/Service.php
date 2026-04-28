<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $guarded = ['id'];

    public function item() { return $this->belongsTo(Item::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function technician() { return $this->belongsTo(Technician::class); }
}
