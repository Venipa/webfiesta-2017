<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCats extends Model
{
    protected $connection = 'mssql_mall';
    protected $primaryKey = 'nID';
    protected $table = 'tCats';
    protected $guarded = ['nID'];

    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function items() {
        return $this->hasMany(Shop::class, "nCat", "nCat");
    }
}
