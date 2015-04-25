<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultSadrzaji extends Model{
    protected $table = 'default_sadrzaji';
    protected $fillable = ['naziv','sadrzaj','created_at','updated_at','templejt_id'];
}