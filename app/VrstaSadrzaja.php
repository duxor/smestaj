<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrstaSadrzaja extends Model{
    protected $table = 'vrsta_sadrzaja';
    protected $fillable = ['naziv','created_at', 'updated_at'];
}