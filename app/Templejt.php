<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templejt extends Model{
    protected $table = 'templejt';
    protected $fillable = ['slug','created_at','updated_at','vrsta_sadrzaja_id','tema_id'];
}