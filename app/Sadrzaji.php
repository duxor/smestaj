<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sadrzaji extends Model{
    protected $table = 'sadrzaji';
    protected $fillable = ['naziv','sadrzaj','created_at','updated_at','templejt_id','nalog_id'];
}