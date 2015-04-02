<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kapacitet extends Model{
    protected $table = 'pravapristupa';
    protected $fillable = ['naziv', 'broj_kreveta', 'created_at', 'updated_at'];
}