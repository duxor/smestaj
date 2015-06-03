<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nalog extends Model{
    protected $table = 'nalog';
    protected $fillable = ['naziv','slug','aktivan','saradnja','created_at','updated_at','korisnici_id','tema_id','opis','facebook','google','twitter','skype'];
}