<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Security;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Log extends Controller {
	public function getLogin(){
		if(Security::autentifikacijaTest()) return Security::rediectToLogin();
		return view('log.index');
	}
	public function postLogin(){
		return Security::login(Input::get('username'),Input::get('password'));
	}
	public function getLogout(){
		return Security::logout();
	}
	public function postRegistracija(){
		return Security::registracija(Input::get('reg_username'),Input::get('reg_email'),Input::get('reg_password'),Input::get('reg_password_potvrda'),Input::get('reg_prezime'),Input::get('reg_ime'));
	}
}
