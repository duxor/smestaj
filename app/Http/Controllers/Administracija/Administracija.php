<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Security;
use Illuminate\Support\Facades\Input;

class Administracija extends Controller {

	public function getIndex(){
		return Security::autentifikacija('administracija.index',null,5,'min');
	}
	public function getLogin(){
		if(Security::autentifikacijaTest(5,'min')) return redirect('/administracija');
		return view('log.login');
	}
	public function postLogin(){
		return Security::login(Input::get('username'),Input::get('password'));
	}
	public function getLogout(){
		return Security::logout();
	}

}
