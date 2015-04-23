<?php namespace App\Http\Controllers;

use App\Grad;
use App\Http\Requests;

use App\Objekat;
use Illuminate\Support\Facades\Input;
use App\Templejt;

class Pretraga extends Controller {
	public function anyIndex(){
		$tacan_broj=Input::get('tacan_broj')?'':'>';

		$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->orderBy('redoslijed')->get(['slug','naziv','vrsta_sadrzaja_id','icon'])->toArray();

		$podaci['broj_osoba']=Input::get('broj_osoba')?Input::get('broj_osoba'):1;
		$podaci['rezultat']=Objekat::
			join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba',$tacan_broj.'=',$podaci['broj_osoba'])
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->get(['smestaj.naziv','adresa','broj_osoba'])->toArray();
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

	}
	public function getMarkeriIzbor(){
		$nalozi=Objekat::join('nalog','nalog.id','=','objekat.nalog_id')
			->join('smestaj','smestaj.objekat_id','=','objekat.id')
			->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->where('grad_id',Input::get('grad_id'))->where('broj_osoba',(Input::get('tacan_broj')?'':'>').'=',Input::get('broj_osoba'))
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->get(['objekat.id','objekat.naziv','slug','x','y','adresa'])->toArray();
		//$nalozi=Objekat::join('nalog','nalog.id','=','objekat.nalog_id')->whereNotNull('x')->get(['objekat.id','objekat.naziv','slug','x','y','adresa'])->toArray();
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
}
