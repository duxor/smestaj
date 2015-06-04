<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objekat extends Model{
    protected $table = 'objekat';
    protected $fillable = ['naziv','opis','created_at', 'updated_at','x','y','z','adresa','aktivan','vrsta_objekta_id','grad_id','nalog_id'];
}