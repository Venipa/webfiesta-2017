<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterShape extends Model
{
    protected $connection = 'mssql_character';
    protected $primaryKey = 'nCharNo';
    protected $table = 'tCharacterShape';
    protected $guarded = ['nCharNo'];
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
