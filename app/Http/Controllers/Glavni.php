<?php namespace App\Http\Controllers;

use App\Grad;
use App\Templejt;
use App\Korisnici;
use App\Security;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
	public function getMarkeri(){
		$niz = 'onLoadMarkers({
  "type": "FeatureCollection",
  "features": [
        {"id":"14614","type":"Feature","geometry":{"type":"Point","coordinates":[20.6844017,43.7246229]},"properties":{"crime_type":"THEFT","date_time":"2011-12-25 22:30:00","description":"GRAND THEFT FROM LOCKED AUTO","case_number":"116164029","address":null,"zip_code":null,"beat":null,"accuracy":"9"}},
        {"id":"14614","type":"Feature","geometry":{"type":"Point","coordinates":[20.505436,44.788241]},"properties":{"crime_type":"THEFT","date_time":"2011-12-25 22:30:00","description":"GRAND THEFT FROM LOCKED AUTO","case_number":"116164029","address":null,"zip_code":null,"beat":null,"accuracy":"9"}},
        {"id":"14614","type":"Feature","geometry":{"type":"Point","coordinates":[18.776330,43.505224]},"properties":{"crime_type":"THEFT","date_time":"2011-12-25 22:30:00","description":"GRAND THEFT FROM LOCKED AUTO","case_number":"116164029","address":null,"zip_code":null,"beat":null,"accuracy":"9"}},
      ]
});';
		return $niz;
	}
	public function getLogin(){
		return view('korisnici.prijava.index');
	}
	public function postLogin(){

		
	}
	public function getProfil(){

		$korisnik=Korisnici::find('4');
		return view('korisnici.profil.index',compact('korisnik'));
		
		
	}
	public function getEditNalog(){

		$korisnik=Korisnici::find('4');//ovo resiti

		
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

	//login korisnika
	public function getPrijava(){
		if(Security::autentifikacijaTest()) return redirect('/profil');
		return view ('/korisnici/autentifikacija/login');
	}
	public function postPrijava(){
		return Security::login(Input::get('username'),Input::get('password'));
			
	}

}
