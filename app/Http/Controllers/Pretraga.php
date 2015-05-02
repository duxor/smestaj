<?php namespace App\Http\Controllers;

use App\Grad;
use App\Http\Requests;

use App\Nalog;
use App\Objekat;
use App\Tema;
use Illuminate\Support\Facades\Input;
use App\Templejt;
use Illuminate\Support\Facades\Session;

class Pretraga extends Controller {
	public function defaultPodaci(){
		return Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->orderBy('redoslijed')->get(['slug','naziv','vrsta_sadrzaja_id','icon'])->toArray();
	}

	public function anyIndex(){
		$tacan_broj=Input::get('tacan_broj')?'':'>';
		$podaci=$this->defaultPodaci();
		$podaci['broj_osoba']=Input::get('broj_osoba')?Input::get('broj_osoba'):1;
		$podaci['rezultat']=Objekat::
			join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('nalog','nalog.id','=','objekat.nalog_id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->leftjoin('lista_zelja',function($query){
				$query->on('lista_zelja.smestaj_id','=','smestaj.id')->where('lista_zelja.aktivan','=',1)->where('lista_zelja.korisnici_id','=',Session::get('id'));
			})
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba',$tacan_broj.'=',$podaci['broj_osoba'])
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->get(['nalog.slug as slugApp','smestaj.id','smestaj.slug as slugSmestaj','smestaj.naziv','adresa','broj_osoba','lista_zelja.id as zelja'])->toArray();
		$podaci['gradovi']=Grad::lists('naziv','id');
		$podaci['grad_id']=Input::get('grad_id');
		$podaci['tacan_broj']=Input::get('tacan_broj');
		$podaci['grad_koo']=Grad::find(Input::get('grad_id'),['x','y','z']);
		return view('aplikacija.teme-osnove.osnovna.pretraga',compact('podaci'));
	}
	public function postSmestaji(){
		$smestaj=Objekat::where('naziv','Like','%'.Input::get('naziv').'%')->get()->toArray();
		dd($smestaj);
	}
	public function postOsnovna(){
		return'postOsnovna';
	}
	public function getMarkeriIzbor(){
		$nalozi=Objekat::join('nalog','nalog.id','=','objekat.nalog_id')
			->join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba',(Input::get('tacan_broj')?'':'>').'=',Input::get('broj_osoba'))
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->get(['objekat.id','objekat.naziv','slug','x','y','adresa'])->toArray();
		$niz = 'onLoadMarkers({"type": "FeatureCollection","features": [';
		$i=0;
		foreach($nalozi as $nalog){
			if($i==0)$i=1;
			else $niz.=',';
			$niz.='{"id":"'.$nalog['id'].'","slug":"'.$nalog['slug'].'","type":"Feature","geometry":{"type":"Point","coordinates":['.$nalog['x'].','.$nalog['y'].']},"properties":{"naslov":"'.$nalog['naziv'].'","description":null,"case_number":null,"address":null,"zip_code":null,"beat":null,"accuracy":"9"}}';
		}
		$niz.=']});';
		return $niz;
	}
	public function getMarkeriGradovi(){
		$nalozi=Grad::whereNotNull('x')->get(['id','naziv','x','y']);
		$niz = 'onLoadMarkers({"type": "FeatureCollection","features": [';
		$i=0;
		foreach($nalozi as $nalog){
			if($i==0)$i=1;
			else $niz.=',';
			$niz.='{"id":"'.$nalog['id'].'","type":"Feature","geometry":{"type":"Point","coordinates":['.$nalog['x'].','.$nalog['y'].']},"properties":{"naslov":"'.$nalog['naziv'].'","description":null,"case_number":null,"address":null,"zip_code":null,"beat":null,"accuracy":"9"}}';
		}
		$niz.=']});';
		return $niz;
	}
	public function getAplikacija($id=null){
		if(!$id) return '';
		$objekti=Objekat::where('nalog_id',$id)->where('aktivan',1)->get(['id','naziv','x','y']);
		$niz = 'onLoadMarkers({"type": "FeatureCollection","features": [';
		$i=0;
		foreach($objekti as $objekat){
			if($i==0)$i=1;
			else $niz.=',';
			$niz.='{"id":"'.$objekat['id'].'","naziv":"'.$objekat['naziv'].'","type":"Feature","geometry":{"type":"Point","coordinates":['.$objekat['x'].','.$objekat['y'].']},"properties":{"naslov":"'.$objekat['naziv'].'","description":null,"case_number":null,"address":null,"zip_code":null,"beat":null,"accuracy":"9"}}';
		}
		$niz.=']});';
		return $niz;
	}

	//################# APP
	public function postAplikacija(){
		if(Input::get('aplikacija')=='') return'';//nalog.id
		$tacan_broj=Input::get('tacan_broj')?'':'>';
		$podaci=$this->defaultPodaci();//templejt sa menijem bez podataka
		$podaci['broj_osoba']=Input::get('broj_osoba')?Input::get('broj_osoba'):1;
		$podaci['rezultat']=Objekat::
		join('nalog','nalog.id','=','objekat.nalog_id')
			->join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->leftjoin('lista_zelja',function($query){
				$query->on('lista_zelja.smestaj_id','=','smestaj.id')->where('lista_zelja.aktivan','=',1)->where('lista_zelja.korisnici_id','=',Session::get('id'));
			})
			->where('objekat.nalog_id',Input::get('aplikacija'))
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba',$tacan_broj.'=',$podaci['broj_osoba'])
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->get(['nalog.slug as slugApp','smestaj.id','smestaj.slug as slugSmestaj','smestaj.naziv','adresa','broj_osoba','lista_zelja.id as zelja'])->toArray();
		$podaci['gradovi']=Grad::join('objekat','objekat.grad_id','=','grad.id')->where('objekat.nalog_id',Input::get('aplikacija'))->orderBy('grad.id')->get(['grad.id','grad.naziv'])->lists('naziv','id');
		$podaci['grad_id']=Input::get('grad_id');
		$podaci['tacan_broj']=Input::get('tacan_broj');
		$podaci['grad_koo']=Grad::find(Input::get('grad_id'),['x','y','z']);
		$podaci['app']=Input::get('aplikacija');//nalog_id
		$tema=Tema::find(Nalog::find(Input::get('aplikacija'),['tema_id'])->tema_id, ['slug'])->slug;
		return view('aplikacija.teme.'.$tema.'.pretraga',compact('podaci'));
	}
	//################# EndApp
}
