<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $connection = 'mssql_web';
    protected $primaryKey = 'id';
    protected $table = 'srr_transactions';
    protected $guarded = ['id'];

    const CREATED_AT = null;
    const UPDATED_AT = null;
}
