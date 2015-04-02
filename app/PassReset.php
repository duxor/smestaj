<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassReset extends Model{
    protected $table = 'pass_reset';
    protected $fillable = ['token','created_at', 'korisnici_id'];
}