<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Security;
use App\Rezervacije;

class Rezervacija extends Controller {

	public function getAktivne(){
		$rezervacije=Rezervacije::where('rezervacije.korisnici_id','=',Session::get('id'))
					->where('rezervacije.aktivan','=',1)
					->join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
					->get(['rezervacije.id','rezervacije.od','rezervacije.do','rezervacije.broj_osoba','rezervacije.napomena',
					'smestaj.naziv','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as br_osoba_kapaciteta',
					'vrsta_smestaja.naziv as vrsta_smestaja_naziv'])->toArray();
		return Security::autentifikacija('korisnik.rezervacije-aktivne', compact('rezervacije'),2);

	}
	public function getIzmeniRezervaciju($id){
				
	}	

}
