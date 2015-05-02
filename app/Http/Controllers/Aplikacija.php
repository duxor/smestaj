<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\ListaZelja;
use App\Nalog;
use App\Templejt;
use App\Grad;
use App\Security;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Aplikacija extends Controller {
	public function getIndex($slug=null){
		if(!$slug){//Osnovna
			$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','<>',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();
			$podaci['pocetna']=true;
			$podaci['pozadine']=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','=',6)->orderBy('redoslijed')->get(['sadrzaj'])->toArray();
			$podaci['grad']=Grad::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
			return view('aplikacija.teme-osnove.osnovna.index',compact('podaci'));
		}
		//####################### Mod App
		$nalog=Nalog::join('tema','tema.id','=','nalog.tema_id')->where('nalog.slug',$slug)->where('nalog.aktivan',1)->get(['nalog.id','tema_id','nalog.naziv','nalog.slug as nalog_slug','tema.slug as tema_slug'])->first();
		if($nalog){
			$nalog=$nalog->toArray();
			$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id',$nalog['id'])->where('tema_id',$nalog['tema_id'])->where('vrsta_sadrzaja_id','<>',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();
			$podaci['pocetna']=true;
			$podaci['pozadine']=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id',1)->where('tema_id',1)->where('vrsta_sadrzaja_id',6)->orderBy('redoslijed')->get(['sadrzaj'])->toArray();
			$podaci['grad']=Grad::join('objekat','objekat.grad_id','=','grad.id')->where('objekat.nalog_id',$nalog['id'])->orderBy('grad.id')->get(['grad.id','grad.naziv'])->lists('naziv','id');
			$podaci['app']=$nalog['id'];
			return view("aplikacija.teme.{$nalog['tema_slug']}.index",compact('podaci'));
		}else return'Aplikacija nije aktivna!';
	}
	public function getSmestaj($slugApp,$slugSmestaj){
		return $slugApp.'/'.$slugSmestaj;
		return view("aplikacija.teme.{$nalog['tema_slug']}.smestaj",compact('podaci'));
	}
	public function postListaZeljaDodaj(){
		if(Input::get('zelja'))
		if(Input::get('zelja')=="false") {
			$lista=new ListaZelja();
			$lista->smestaj_id=Input::get('smestaj');
			$lista->korisnici_id=Input::get('korisnik');
			$lista->save();
			return $lista->id;
		}else
		ListaZelja::find(Input::get('zelja'))->update(['aktivan'=>0]);
		return ;
	}
	public function getListaZelja(){
		$lista_zelja=ListaZelja::where('korisnici_id','=',Session::get('id'))
						->where('lista_zelja.aktivan','=','1')
						->join('smestaj','smestaj.id','=','lista_zelja.smestaj_id')
						->join('objekat','objekat.id','=','smestaj.objekat_id')
						->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
						->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
						->get(['smestaj.id','smestaj.naziv','objekat.naziv as naziv_objekta',
							'vrsta_smestaja.naziv as naziv_smestaja','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as broj_osoba'])->toArray();
		return view('korisnik.lista-zelja',compact('lista_zelja'));
	}
	public function getUkloniListaZelja($id){
		ListaZelja::where('korisnici_id','=',Session::get('id'))
		->where('smestaj_id','=',$id)->update(['aktivan'=>'0']);
				return Redirect::back();
	}
}
