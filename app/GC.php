<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GC extends Model
{
    protected $connection = 'mssql_web';
    protected $primaryKey = 'id';
    protected $table = 'giftcards';
    protected $guarded = ['id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
}
