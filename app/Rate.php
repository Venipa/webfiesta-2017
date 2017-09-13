<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $connection = 'mssql_web';
    protected $primaryKey = 'id';
    protected $table = 'rate';
    protected $guarded = ['id'];

    const CREATED_AT = null;
    const UPDATED_AT = null;
}
