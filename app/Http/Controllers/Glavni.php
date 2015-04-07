<?php namespace App\Http\Controllers;

use App\Grad;
use App\Templejt;
use App\Korisnici;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Glavni extends Controller {

	public function getIndex(){
		$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')
			->where('nalog_id','=',1)->where('tema_id','=',1)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id'])->toArray();
		$podaci['foother']=false;
		$podaci['pozadine']=[
			'teme/osnovna-paralax/slike/15.jpg',//8
			'teme/osnovna-paralax/slike/19.jpg',
			'teme/osnovna-paralax/slike/28.jpg',
			'teme/osnovna-paralax/slike/34.jpg',
		];
		$podaci['icon']=[
			'',
			'glyphicon glyphicon-search',
			'glyphicon glyphicon-calendar',
			'glyphicon glyphicon-earphone',
			''
		];
		$podaci['grad']=Grad::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
		return view('aplikacija.index',compact('podaci'));
	}
	public function getLogin(){
		Security::registracija(Input::get('email'),Input::get('password'));
	}
	public function postLogin(){

		
	}
	public function getProfil(){

		$korisnik=Korisnici::find('4');
		return view('korisnici.profil.index',compact('korisnik'));
		
		
	}
	public function getEditNalog(){

		$korisnik=Korisnici::find('4');
		return view('korisnici.profil.edit',compact('korisnik'));
		
		
	}
	public function postFormEdit(){

		$korisnik= Korisnici::firstOrNew(['id'=>Input::get('id')],['id','prezime','ime' ,'username','email']);  
		$korisnik->prezime=Input::get('prezime');
		$korisnik->ime=Input::get('ime');
		$korisnik->username=Input::get('username');
		$korisnik->email=Input::get('email');;
		$korisnik->save();
		$korisnik=Korisnici::find('4');
		return view('korisnici.profil.index',compact('korisnik'));

		
		
	}

}
