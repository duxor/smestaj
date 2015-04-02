<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 3/1/2015
 * Time: 11:42 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Grad extends Model{
    protected $table = 'grad';
    protected $fillable = ['naziv','created_at','updated_at','drzava_id'];
}