<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Security;
use Illuminate\Support\Facades\Input;

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
}
