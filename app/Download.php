<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $connection = 'mssql_web';
    protected $primaryKey = 'id';
    protected $table = 'downloads';
    protected $guarded = ['id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
}
