<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nalog extends Model{
    protected $table = 'nalog';
    protected $fillable = ['naziv', 'slug', 'aktivan', 'created_at', 'updated_at','korisnici_id','tema_id'];
}