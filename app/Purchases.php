<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $primaryKey = "nID";
    protected $table = 'tPurchases';
    protected $guarded = ['nID'];

    const CREATED_AT = 'dDate';
    const UPDATED_AT = null;

    public function items() {
        return $this->hasOne(ItemUse::class, "nOrderID");
    }

}