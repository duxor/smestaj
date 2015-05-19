<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Dodatno extends Model{
    protected $table='dodatno';
    protected $fillable=['naziv','smestaj_id','dodatna_oprema_id','created_at','updated_at'];
}