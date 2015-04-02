<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrstaObjekta extends Model{
    protected $table = 'vrsta_objekta';
    protected $fillable = ['naziv','created_at', 'updated_at'];
}