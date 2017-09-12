<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $connection = 'mssql_character';
    protected $primaryKey = 'nCharNo';
    protected $table = 'tCharacter';
    protected $guarded = ['nCharNo'];

    const CREATED_AT = 'dCreateDate';
    const UPDATED_AT = null;

    public function user() {
        return $this->hasOne(User::class, "nUserNo");
    }
    
    public function shape() {
        return $this->hasOne(CharacterShape::class, "nCharNo");
    }
}
