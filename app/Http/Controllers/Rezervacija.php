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
		$rez= new Rezervacije;
		$rez->od=Input::get('datumOd');
		$rez->do=Input::get('datumDo');
		$rez->korisnici_id=Session::get('id');
		$rez->smestaj_id=Input::get('id_smestaja');
		$rez->napomena=Input::get('napomena');
		$rez->save();
		$message[]='Uspešno ste izvršili rezervaciju';
		return Redirect::to('/rezervacije/aktivne')->with(compact('message'));

	}
	public function postIzmeniRezervaciju(){
		$message=[];
		$id_smestaja=Input::get('smestaj_id');
		$datum_od=Input::get('datumOd');
		$datum_do=Input::get('datumDo');//zeljeni datum
		$sadasnji=date("Y-m-d"); 
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
