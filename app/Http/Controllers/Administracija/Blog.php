<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Security;
use Illuminate\Support\Facades\Input;

class Blog extends Controller {

	public function getIndex(){
		return Security::autentifikacija('administracija.index',null,5,'min');
	}
	

}