<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



class Korisnici extends  Model{
    protected $table = 'korisnici';
    protected $fillable = ['prezime', 'ime', 'username', 'email', 'password', 'token', 'rezervacija', 'created_at', 'updated_at', 'pravaPristupa_id'];
    
    /*public static function validate($input) {
        $rules = array(
        'username'	=> 'Required|Between:5,12|Unique:korisnici',
        'Email'     => 'Required|Between:3,64|Email|Unique:korisnici',
		);
		$v = Validator::make($input, $rules);
    }
*/
		
}