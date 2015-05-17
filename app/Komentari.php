<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Komentari extends Model{
    protected $table='komentari';
    protected $fillable=['komentar','created_at','updated_at','smestaj_id','korisnici_id','ocena','aktivan','odgovor_za_id'];
}