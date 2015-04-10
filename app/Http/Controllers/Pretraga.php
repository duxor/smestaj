<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Objekat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Pretraga extends Controller {
	public function postIndex(){
		$rezultat=Objekat::join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba','>=',Input::get('broj_osoba'))->get()->toArray();
		dd(Input::all(),$rezultat);
	}
	public function postOsnovna(){

	}
}
