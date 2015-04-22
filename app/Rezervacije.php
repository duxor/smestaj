<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Rezervacije extends Model{
    protected $table='rezervacije';
    protected $fillable=['od','do','broj_osoba','korisnici_id','smestaj_id','napomena','created_at','updated_at'];
}