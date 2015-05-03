<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Security;
use App\Rezervacije;
use App\Kapacitet;

class Rezervacija extends Controller {

	public function getAktivne(){
	
		//$kapacitet_id=Smestaj::where('objekat_id','=','nestoasdfasdf')
		//->get(['kapacitet_id','vrsta_smestaja_id'])


		$nk=Rezervacije::where('rezervacije.korisnici_id','=',Session::get('id'))
					->where('rezervacije.aktivan','=',1)
					->join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->get(['kapacitet.id','kapacitet.naziv'])->lists('naziv','id');

		$rezervacije=Rezervacije::where('rezervacije.korisnici_id','=',Session::get('id'))
					->where('rezervacije.aktivan','=',1)
					->join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
					->get(['rezervacije.id','rezervacije.od','rezervacije.do','rezervacije.broj_osoba','rezervacije.napomena',
					'smestaj.naziv','smestaj.objekat_id as obj','kapacitet.id as idkap','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as br_osoba_kapaciteta',
					'vrsta_smestaja.naziv as vrsta_smestaja_naziv'])->toArray();
					
		return Security::autentifikacija('korisnik.rezervacije-aktivne', compact('rezervacije','nk'),2);

	}
	public function getIzmeniRezervaciju($id){

				
	}	
	public function postOtkaziRezervaciju(){
		Rezervacije::where('korisnici_id','=',Session::get('id'))
		->where('rezervacije.id','=',Input::get('rezervacija'))->update(['aktivan'=>0]);
				return Redirect::back();		
	}

}
