<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class BlogTabela extends Model{
    protected $table = 'blog';
    protected $fillable = ['naslov','tekst','created_at','updated_at','nalog_id','korisnici_id','aktivan'];
}