<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $connection = 'mssql_mall';
    protected $primaryKey = 'nID';
    protected $table = 'tItems';
    protected $guarded = ['nID'];

    const CREATED_AT = 'dSaleStart';
    const UPDATED_AT = null;
}
