<?php namespace App\Http\Controllers\Moderacija;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Komentari;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Security;
use App\Nalog;
use App\Sadrzaji;
use App\Objekat;
use App\VrstaObjekta;
use App\Grad;
use App\Smestaj;
use App\VrstaSmestaja;
use App\Kapacitet;
use App\Rezervacije;
use App\Korisnici;
class Rezervacija extends Controller {
	public function getIndex(){
	}
	public function getAktuelne(){
			$rezervacije=Korisnici::where('korisnici.id',Session::get('id'))
					->where('rezervacije.aktivan',1)
					->join('nalog','nalog.korisnici_id','=','korisnici.id')
					->join('objekat','objekat.nalog_id','=','nalog.id')
					->join('smestaj','smestaj.objekat_id','=','objekat.id')
					->join('rezervacije','rezervacije.smestaj_id','=','smestaj.id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
					->get(['korisnici.username','rezervacije.od','rezervacije.do','rezervacije.broj_osoba','rezervacije.napomena',
						'smestaj.naziv','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as br_osoba_kapaciteta',
						'vrsta_smestaja.naziv as vrsta_smestaja_naziv','rezervacije.id'])->toArray();
		
			return Security::autentifikacija('moderacija.rezervacija.aktuelno', compact('rezervacije'),4);
	}
	public function getArhiva(){
			$rezervacije=Korisnici::orderBy('odjava', 'desc')
					->where('korisnici.id',Session::get('id'))
					->where('rezervacije.aktivan',0)
					->join('nalog','nalog.korisnici_id','=','korisnici.id')
					->join('objekat','objekat.nalog_id','=','nalog.id')
					->join('smestaj','smestaj.objekat_id','=','objekat.id')
					->join('rezervacije','rezervacije.smestaj_id','=','smestaj.id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
					->get(['korisnici.username','rezervacije.od','rezervacije.do','rezervacije.broj_osoba','rezervacije.napomena',
						'smestaj.naziv','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as br_osoba_kapaciteta',
						'vrsta_smestaja.naziv as vrsta_smestaja_naziv','rezervacije.id','odjava'])->toArray();		
			return Security::autentifikacija('moderacija.rezervacija.arhiva', compact('rezervacije'),4);
	}
	public function getGosti(){
		$korisnici=Korisnici::where('rezervacije.korisnici_id',Session::get('id'))
			->join('nalog','nalog.korisnici_id','=','korisnici.id')
			->join('objekat','objekat.nalog_id','=','nalog.id')
			->join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('rezervacije','rezervacije.smestaj_id','=','smestaj.id')
			->get(['korisnici.prezime as pr','korisnici.ime as ime_korisnika','korisnici.username','korisnici.email as email_korisnika',
				'korisnici.fotografija as fotografija_korisnika','smestaj.naziv as naziv_smestaja',
				'rezervacije.od','rezervacije.do','rezervacije.utisci','rezervacije.ocena','smestaj.slug as slugSmestaj','nalog.slug as slugApp'])->toArray();
		return Security::autentifikacija('moderacija.rezervacija.gosti',compact('korisnici'),4);
	}

	public function postOdjaviKorisnika(){
		if(!Security::autentifikacijaTest(4,'min'))return Security::rediectToLogin();
		Rezervacije::where('rezervacije.id',Input::get('id'))->update(['aktivan'=>0,'odjava'=>date("Y-m-d"),'utisci'=>Input::get('utisci'),'ocena'=>Input::get('rating')]);
				return Redirect::back();
			
	}
}
