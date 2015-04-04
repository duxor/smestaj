<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\OsnovneMetode;
use App\Sadrzaj;
use App\Security;
use App\Tema;
use App\TemplejtSadrzaja;
use Illuminate\Support\Facades\Input;

class Aplikacija extends Controller {
//# OPTIMIZACIJU KODA RADITI NAKON IZRADE[PRVO IZVRSITI AUTENTIFIKACIJU PA TEK ONDA GETOVATI PODATKE]
//# KOD UKLANJANJA TREBA DODATI, DA SE PRVO BRISU SVI PODZAPISI

	public function getTema(){
		$teme = Tema::get(['slug','naziv','opis'])->toArray();
		return Security::autentifikacija('aplikacija.tema.index', compact('teme'));
	}
	public function getTemaNova(){
		return Security::autentifikacija('aplikacija.tema.edit', null);
	}
	public function postTemaNova(){
		if(Security::autentifikacijaTest()){
			$tema=Tema::firstOrNew(['id'=>Input::get('id')],['id','naziv','slug']);
			$tema->naziv=Input::get('naziv');
			$tema->slug=Input::get('slug');
			$tema->opis=Input::get('opis');
			$tema->save();
			return redirect('/administracija/aplikacija/tema');
		}
		return Security::rediectToLogin();
	}
	public function getTemaEdit($slug){
		$tema=Tema::where('slug','=',$slug)->get(['id','slug','naziv','opis'])->first()->toArray();
		return Security::autentifikacija('aplikacija.tema.edit',compact('tema'));
	}
	public function getTemaUkloni($slug){
		if(Security::autentifikacijaTest()){
			//* potrebno je ukloniti sve pod zapise
			//...
			Tema::where('slug','=',$slug)->delete();
			return redirect('/administracija/aplikacija/tema');
		}
		return Security::rediectToLogin();
	}

}
