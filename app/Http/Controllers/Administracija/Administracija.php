<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Security;
use Illuminate\Support\Facades\Input;

class Administracija extends Controller {

	public function getIndex(){
		return Security::autentifikacija('stranice.administracija.index',null);
	}
	public function getLogin(){
		if(Security::autentifikacijaTest()) return redirect('/administracija');
		return view('stranice.administracija.login');
	}
	public function postLogin(){
		return Security::login(Input::get('username'),Input::get('password'));
	}
	
	
	public function getLogout(){
		return Security::logout();
	}

}
