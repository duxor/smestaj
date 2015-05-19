<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class DodatnaOprema extends Model{
    protected $table='dodatna_oprema';
    protected $fillable=['naziv','opis','created_at','updated_at'];
}