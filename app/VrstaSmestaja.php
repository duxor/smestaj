<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrstaSmestaja extends Model{
    protected $table = 'vrsta_smestaja';
    protected $fillable = ['naziv','created_at', 'updated_at'];
}