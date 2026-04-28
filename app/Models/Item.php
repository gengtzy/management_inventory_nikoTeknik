<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $guarded = ['id'];

    public function inbounds() { return $this->hasMany(Inbound::class); }
    public function sales() { return $this->hasMany(Sale::class); }
}
