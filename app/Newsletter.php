<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Newsletter extends Model{
    protected $table = 'newsletter';
    protected $fillable = ['korisnici_id','email','token','aktivan','nalog_id','created_at','updated_at'];
}