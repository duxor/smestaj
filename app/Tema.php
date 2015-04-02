<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model{
    protected $table = 'tema';
    protected $fillable = ['naziv','created_at', 'updated_at'];
}