<?php namespace App\Http\Controllers\Korisnik;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Security;

class Korisnik extends Controller {
	public function getIndex(){
		return Security::autentifikacija('korisnik.index');
	}
}
