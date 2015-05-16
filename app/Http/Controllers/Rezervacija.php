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
	public function postIndex(){
		return '_token='.Input::get('_token')
		.'<br>od='.Input::get('od')
		.'<br>do='.Input::get('do')
		.'<br>broj_osoba='.Input::get('broj_osoba')
		.'<br>korisnik_id='.Input::get('korisnik_id')
		.'<br>smestaj_id='.Input::get('smestaj_id');
	}
	public function getAktivne(){
		$broj_osoba=Rezervacije::where('rezervacije.korisnici_id','=',Session::get('id'))
					->where('rezervacije.aktivan','=',1)
					->join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->get(['kapacitet.id','kapacitet.broj_osoba'])->lists('broj_osoba','id');
		$rezervacije=Rezervacije::where('rezervacije.korisnici_id','=',Session::get('id'))
					->where('rezervacije.aktivan','=',1)
					->join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
					->get(['rezervacije.id','rezervacije.od','rezervacije.do','rezervacije.broj_osoba','rezervacije.smestaj_id','rezervacije.napomena',
					'smestaj.naziv','smestaj.objekat_id as obj','kapacitet.id as id_kapaciteta','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as br_osoba_kapaciteta',
					'vrsta_smestaja.id as id_vrsta_smestaja','vrsta_smestaja.naziv as vrsta_smestaja_naziv'])->toArray();
		return Security::autentifikacija('korisnik.rezervacije-aktivne', compact('rezervacije','broj_osoba'),2);
	}
	public function postRezervisi(){
		$podaci=json_decode(Input::get('podaci'));
		$rez= new Rezervacije();
		$rez->od=$podaci->datumOd;
		$rez->do=$podaci->datumDo;
		$rez->korisnici_id=$podaci->id_korisnika;
		$rez->smestaj_id=$podaci->id_smestaja;
		$rez->napomena=$podaci->napomena;
		$rez->broj_osoba=$podaci->broj_osoba;
		$rez->cena_ukupna=$podaci->ukupna_cena;
		$rez->save();
		return json_encode(['msg'=>'Uspešno ste izvršili rezervaciju.','check'=>1]);
	}
	public function postIzmeniRezervaciju(){
		$message=[];
		$id_smestaja=Input::get('smestaj_id');
		$datum_od=Input::get('datumOd');
		$datum_do=Input::get('datumDo');//zeljeni datum
		$broj_osoba=Input::get('broj_osoba');
		$broj_osoba_kapaciteta=Rezervacije::where('rezervacije.korisnici_id','=',Session::get('id'))
					->where('rezervacije.aktivan','=',1)
					->join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
					->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
					->get(['kapacitet.id as id_kapaciteta','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as br_osoba_kapaciteta'
					])->first();
		
		if($broj_osoba > $broj_osoba_kapaciteta->br_osoba_kapaciteta)		
		{
			$message[]='Izabrani broj osoba je veći od kapaciteta datog smeštaja';
			$message[]='Maksimalan broj osoba u kapacitetu '.$broj_osoba_kapaciteta->naziv_kapaciteta.' je: '.$broj_osoba_kapaciteta->br_osoba_kapaciteta;
			$message[]='Izaberite drugi smeštaj ili smanjite broj osoba!';
			
		}
		$datumi=Rezervacije::orderBy('od')->where('smestaj_id','=',$id_smestaja)//datumi svih rezervacija za dati smestaj ostalih korisnika
			->where('korisnici_id','!=',Session::get('id'))
			->get(['od','do'])->toArray();//datumi iz baze
			
		foreach ($datumi as $dat) 
		{
			if(($datum_od >$dat['od']&&$datum_od<$dat['do'] ) || ($datum_do >$dat['od']&&$datum_do<$dat['do'] ) )
			{
				$message[]='Datum od: '.$dat['od'].' do '.$dat['do'].' je zauzet';
			}
		}
		if($message==null){
			$message[]='Uspešno ste uneli izmene!';
			Rezervacije::where('korisnici_id','=',Session::get('id'))
				->where('rezervacije.id','=',Input::get('rezervacija'))
				->update(['od'=>$datum_od,'do'=>$datum_do,'broj_osoba'=>$broj_osoba]);
			return Redirect::back()->with(compact('message'));
		}else
		return Redirect::back()->with(compact('message'));				
	}	
	public function postOtkaziRezervaciju(){
		Rezervacije::where('korisnici_id','=',Session::get('id'))
		->where('rezervacije.id','=',Input::get('rezervacija'))->update(['aktivan'=>0,'odjava'=>date("Y-m-d")]);
				return Redirect::back();		
	}
}