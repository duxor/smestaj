<?php namespace App\Http\Controllers\Moderacija;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Security;

class Moderacija extends Controller {
	public function getIndex(){
		return Security::autentifikacija('moderacija.aplikacija.index');
	}
	public function getPodesavanja()
	{
		return Security::autentifikacija('moderacija.aplikacija.podesavanja');	
	}


}
