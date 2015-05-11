<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Newsletter extends Model{
    protected $table = 'newsletter';
    protected $fillable = ['token','aktivan','nalog_id','korisnici_id','created_at','updated_at'];
}