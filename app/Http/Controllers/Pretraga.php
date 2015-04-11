<?php namespace App\Http\Controllers;

use App\Grad;
use App\Http\Requests;

use App\Objekat;
use Illuminate\Support\Facades\Input;
use App\Security;

class Pretraga extends Controller {
	public function postIndex(){
		$tacan_broj=Input::get('tacan_broj')?'':'>';
		$broj_osoba=Input::get('broj_osoba')?Input::get('broj_osoba'):1;
		$podaci['rezultat']=Objekat::
			join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba',$tacan_broj.'=',$broj_osoba)
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->get(['smestaj.naziv','adresa','broj_osoba'])->toArray();
		$podaci['gradovi']=Grad::lists('naziv','id');
		$podaci['grad_id']=Input::get('grad_id');
		$podaci['tacan_broj']=Input::get('tacan_broj');//dd($podaci['tacan_broj'],Input::get('tacan_broj'),Input::all());
		return view('aplikacija.pretraga',compact('podaci'));
		dd(Input::all(),$podaci,$podsaci['gradovi']);
	}
	public function postOsnovna(){

	}
}
