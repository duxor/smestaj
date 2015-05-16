<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Rezervacije extends Model{
    protected $table='rezervacije';
    protected $fillable=['od','do','broj_osoba','cena_ukupna','korisnici_id','smestaj_id','napomena','aktivan','odjava','utisci','ocena','created_at','updated_at'];
}