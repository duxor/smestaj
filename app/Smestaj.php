<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smestaj extends Model{
    protected $table = 'smestaj';
    protected $fillable = ['naziv','slug','created_at', 'updated_at', 'kapacitet_id', 'vrsta_smestaja_id', 'objekat_id'];
}