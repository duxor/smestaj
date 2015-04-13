<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Security;

class Log extends Controller {
	public function getLogin(){
		if(Security::autentifikacijaTest()) return Security::rediectToLogin();
		return view('korisnik.log.index');
	}
	public function postLogin(){
		return Security::login(Input::get('username'),Input::get('password'));
	}
	public function getLogout(){
		return Security::logout();
	}
}
