<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\OsnovneMetode;
use App\Security;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class Log extends Controller {
	public function getLogin(){
		if(Security::autentifikacijaTest(2,'min')) return Security::rediectToLogin();
		return view('log.index')->with(['return_to_url'=>Input::has('return_to_url')?Input::get('return_to_url'):(session()->has('return_to_url')?Session::get('return_to_url'):Security::comeFromUrl())]);
	}
	public function postLogin(){
		return Security::login(Input::get('username'),Input::get('password'),Input::get('return_to_url'));
	}
	public function getLogout($end=null){
		return Security::logout($end);
	}
	public function postRegistracija(){
		return Security::registracija(Input::get('reg_username'),Input::get('reg_email'),Input::get('reg_password'),Input::get('reg_password_potvrda'),Input::get('reg_prezime'),Input::get('reg_ime'),Input::get('return_to_url'));
	}
}
