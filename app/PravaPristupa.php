<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PravaPristupa extends Model{
    protected $table = 'pravapristupa';
    protected $fillable = ['naziv','created_at', 'updated_at'];
}