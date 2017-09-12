<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemUse extends Model
{
    protected $primaryKey = 'nID';
    protected $table = 'tItemUses';
    protected $guarded = ['nID'];

    const CREATED_AT = 'dDate';
    const UPDATED_AT = null;

    public function purchases() {
        return $this->hasOne(Purchases::class, "nID", "nOrderID");
    }

}
