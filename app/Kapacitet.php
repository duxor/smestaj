<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kapacitet extends Model{
    protected $table = 'kapacitet';
    protected $fillable = ['naziv', 'broj_osoba', 'created_at', 'updated_at'];
}