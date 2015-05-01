<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class ListaZelja extends Model{
    protected $table='lista_zelja';
    protected $fillable=['aktivan','smestaj_id','korisnici_id','updated_at'];
}