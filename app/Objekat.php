<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objekat extends Model{
    protected $table = 'objekat';
    protected $fillable = ['naziv','created_at', 'updated_at','x','y','adresa','aktivan','vrsta_objekta_id','grad_id','nalog_id'];
}