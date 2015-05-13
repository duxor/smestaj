<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 3/1/2015
 * Time: 11:42 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Mailbox extends Model{
    protected $table = 'mailbox';
    protected $fillable = ['korisnici_id','od_id','od_email','naslov','poruka','created_at','updated_at'];
}