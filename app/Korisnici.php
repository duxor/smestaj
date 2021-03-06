<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



class Korisnici extends  Model{
    protected $table = 'korisnici';
    protected $fillable = ['prezime', 'ime', 'username', 'email', 'password', 'token', 'rezervacija', 'created_at', 'updated_at', 'pravaPristupa_id','adresa','grad','telefon','fotografija','facebook','google','twitter','skype'];
}