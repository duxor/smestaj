<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Nalog;
use App\OsnovneMetode;
use App\Sadrzaji;
use App\Security;
use App\Tema;
use App\Templejt;
use App\VrstaSadrzaja;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Aplikacija extends Controller {
//# OPTIMIZACIJU KODA RADITI NAKON IZRADE[PRVO IZVRSITI AUTENTIFIKACIJU PA TEK ONDA GETOVATI PODATKE]
//# KOD UKLANJANJA TREBA DODATI, DA SE PRVO BRISU SVI PODZAPISI ** ODRADJENO

//TEMA START::
	public function getTema(){
		$teme = Tema::get(['id','slug','naziv','opis','aktivan'])->toArray();
		return Security::autentifikacija('administracija.aplikacija.tema.index', compact('teme'));
	}
	public function getTemaNova(){
		return Security::autentifikacija('administracija.aplikacija.tema.edit', null);
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
		return Security::autentifikacija('administracija.aplikacija.tema.edit',compact('tema'));
	}
	public function getTemaUkloni($slug){
		if(Security::autentifikacijaTest()){
			$id=Tema::where('slug','=',$slug)->get(['id'])->first()->id;
			Nalog::where('tema_id','=',$id)->update(['tema_id'=>1]);
			foreach(Templejt::where('tema_id','=',$id)->get(['id'])->toArray() as $templejtID){
				Sadrzaji::destroy($templejtID);
			}
			Templejt::where('tema_id','=',$id)->delete();
			Tema::where('slug','=',$slug)->delete();
			return redirect('/administracija/aplikacija/tema');
		}
		return Security::rediectToLogin();
	}
	public function getTemaStatus($id){
		if(Security::autentifikacijaTest()){
			$tema = Tema::find($id,['id','aktivan'])->first();
			$tema->aktivan = $tema->aktivan ? 0 : 1;
			$tema->save();
			return Redirect::back();
		}
		return Security::rediectToLogin();
	}
//TEMA END::

//TEMPLEJT START::
	public function getTemaTemplejt($slug){
		$templejt=Templejt::join('tema','tema.id','=','templejt.tema_id')
			->join('vrsta_sadrzaja','vrsta_sadrzaja.id','=','templejt.vrsta_sadrzaja_id')
			->where('tema.slug','=',$slug)
			->orderBy('redoslijed')
			->get(['tema.naziv as tema','tema.slug as tema_slug','tema.id as tema_id','opis','templejt.id as templejt_id','templejt.slug','redoslijed','vrsta_sadrzaja_id','vrsta_sadrzaja.naziv as vrsta_sadrzaja'])->toArray();
		return Security::autentifikacija('administracija.aplikacija.templejt.index',compact('templejt'));
	}
	public function postTemaTemplejt($id){
		if(Security::autentifikacijaTest()){
			Templejt::where('id','=',$id)->update(['redoslijed'=>Input::get('redoslijed')]);
			return Redirect::back();
		}
		return Security::rediectToLogin();
	}
	public function postTemplejtEdit($slug){
		$templejt=Templejt::where('id','=',Input::get('templejt_id'))->get(['id','slug','vrsta_sadrzaja_id','tema_id'])->first()->toArray();
		$vrstaSadrzaja=VrstaSadrzaja::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
		return Security::autentifikacija('administracija.aplikacija.templejt.edit',compact('templejt','vrstaSadrzaja','tema_slug'));
	}
	public function postTemplejtNovi(){
		$vrstaSadrzaja=VrstaSadrzaja::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
		$templejt=['tema_id'=>Input::get('tema_id'), 'tema_slug'=>Input::get('tema_slug')];
		return Security::autentifikacija('administracija.aplikacija.templejt.edit',compact('vrstaSadrzaja','templejt'));
	}
	public function postTemplejtNoviSubmit(){
		if(Security::autentifikacijaTest()){
			$templejt=Templejt::firstOrNew(['id'=>Input::get('id')],['id','slug','vrsta_sadrzaja_id']);
				$templejt->slug=Input::get('slug');
				$templejt->vrsta_sadrzaja_id=Input::get('vrsta_sadrzaja_id');
				$templejt->tema_id=Input::get('tema_id');
			$templejt->save();
			return redirect('/administracija/aplikacija/tema-templejt/'.(Tema::find(Input::get('tema_id'))->get(['slug'])->first()->slug));
		}
		return Security::rediectToLogin();
	}
	public function postTemplejtUkloni($id){
		if(Security::autentifikacijaTest()){
			Sadrzaji::where('templejt_id','=',$id)->delete();
			Templejt::destroy($id);
			return Redirect::back();
		}
		return Security::rediectToLogin();
	}
//TEMPLEJT END::

//#OSNOVNA START::
	public function getOsnovna(){
		$templejt=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')
			->join('vrsta_sadrzaja','vrsta_sadrzaja.id','=','templejt.vrsta_sadrzaja_id')
			->join('tema','tema.id','=','templejt.tema_id')
			->where('tema_id','=',1)
			->get(['redoslijed','templejt.slug','vrsta_sadrzaja.naziv as vrsta_sadrzaja','sadrzaji.naziv','sadrzaj','templejt_id',
				'tema.id as tema_id','tema.slug as tema_slug','tema.naziv as tema','tema.opis'])->toArray();
		return Security::autentifikacija('administracija.aplikacija.osnovna.index',compact('templejt'));
	}
	public function getOsnovnaEdit($slug){

	}
//OSNOVNA END::
}
