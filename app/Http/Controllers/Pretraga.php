<?php namespace App\Http\Controllers;

use App\DodatnaOprema;
use App\Grad;
use App\Http\Requests;

use App\Nalog;
use App\Objekat;
use App\OsnovneMetode;
use App\Rezervacije;
use App\Tema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Templejt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Pretraga extends Controller {
	public function defaultPodaci($appID){
		return Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id',$appID)->where('tema_id',Nalog::find($appID,['tema_id'])->tema_id)->orderBy('redoslijed')->get(['slug','naziv','vrsta_sadrzaja_id','icon'])->toArray();
	}
	public function postSmestaji(){
		$podaci=$this->defaultPodaci(1);//templejt sa menijem bez podataka
		$podaci['rezultat']=Nalog::where('naziv','Like','%'.Input::get('naziv').'%')->where('aktivan','=',1)->get(['naziv','slug','opis'])->toArray();
		$podaci['pretragaApp']=Input::get('naziv');
		return view('aplikacija.teme-osnove.osnovna.pretraga',compact('podaci'));
	}
	public function postOsnovna(){
		return'postOsnovna';
	}
	public function getMarkeriIzbor(){
		if(Input::has('like'))
			$nalozi=Objekat::join('nalog','nalog.id','=','objekat.nalog_id')
				->join('smestaj','smestaj.objekat_id','=','objekat.id')
				->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
				->where('nalog.naziv','Like','%'.(Input::get('like')=='null'?'':Input::get('like')).'%')
				->where('nalog.aktivan',1)->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
				->get(['objekat.id','objekat.naziv','nalog.slug as slugApp','smestaj.slug as slugSmestaj','smestaj.id as smestajID','x','y','adresa'])->toArray();
		else
			$nalozi=Objekat::join('nalog','nalog.id','=','objekat.nalog_id')
				->join('smestaj','smestaj.objekat_id','=','objekat.id')
				->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
				->where('grad_id',Input::get('grad_id'))->where('broj_osoba',(Input::get('tacan_broj')?'':'>').'=',Input::get('broj_osoba'))
				->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
				->get(['objekat.id','objekat.naziv','nalog.slug as slugApp','smestaj.slug as slugSmestaj','smestaj.id as smestajID','x','y','adresa'])->toArray();
		$nalozi=OsnovneMetode::dostupnostZaRezervaciju($nalozi,Input::get('datumOd'),Input::get('datumDo'),'smestajID');

		$niz = 'onLoadMarkers({"type": "FeatureCollection","features": [';
		$i=0;
		foreach($nalozi as $nalog){
			if($i==0)$i=1;
			else $niz.=',';
			$niz.='{"id":"'.$nalog['id'].'","link":"/'.$nalog['slugApp'].'/'.$nalog['slugSmestaj'].'","type":"Feature","geometry":{"type":"Point","coordinates":['.$nalog['x'].','.$nalog['y'].']},"properties":{"naslov":"'.$nalog['naziv'].'","description":null,"case_number":null,"address":null,"zip_code":null,"beat":null,"accuracy":"9"}}';
		}
		$niz.=']});';
		return $niz;
	}
	public function anyIndex($slugApp=null){
		if($slugApp&&Input::get('aplikacija')=='') return Redirect::to('/'.$slugApp);//nalog.id
		$tacan_broj=Input::get('tacan_broj')?'':'>';
		$podaci=$this->defaultPodaci($slugApp?Input::get('aplikacija'):1);//templejt sa menijem bez podataka
		$podaci['broj_osoba']=Input::get('broj_osoba')?Input::get('broj_osoba'):1;
		$podaci['rezultat']=Objekat::
		join('smestaj','smestaj.objekat_id','=','objekat.id')
			->leftjoin('nalog','nalog.id','=','objekat.nalog_id')
			->leftjoin('korisnici as k','k.id','=','nalog.korisnici_id')
			->leftjoin('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->leftjoin('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
			->leftjoin('lista_zelja',function($query){
				$query->on('lista_zelja.smestaj_id','=','smestaj.id')->where('lista_zelja.aktivan','=',1)->where('lista_zelja.korisnici_id','=',Session::get('id'));
			})
			->groupby('id')
			->where('grad_id',Input::get('grad_id'))->where('kapacitet.broj_osoba',$tacan_broj.'=',$podaci['broj_osoba'])
			->where('objekat.aktivan',1)->where('smestaj.aktivan',1)
			->orderBy('smestaj.naziv')
			->select('nalog.naziv as nazivApp','nalog.slug as slugApp','vrsta_smestaja.naziv as vrsta_smestaja','smestaj.id',
				'smestaj.slug as slugSmestaj','smestaj.naziv','objekat.adresa','kapacitet.broj_osoba','lista_zelja.id as zelja','naslovna_foto','cena_osoba','k.username')->get()->toArray();
		$podaci['rezultat']=OsnovneMetode::dostupnostZaRezervaciju($podaci['rezultat'],Input::get('datumOd'),Input::get('datumDo'));
		$podaci['filter']=OsnovneMetode::dodatnaOprema($podaci['rezultat']);
		$podaci['gradovi']=$slugApp?Grad::join('objekat','objekat.grad_id','=','grad.id')->where('objekat.nalog_id',Input::get('aplikacija'))->orderBy('grad.id')->get(['grad.id','grad.naziv'])->lists('naziv','id'):Grad::lists('naziv','id');
		$podaci['grad_id']=Input::get('grad_id');
		$podaci['tacan_broj']=Input::get('tacan_broj');
		$podaci['grad_koo']=Grad::find(Input::get('grad_id'),['x','y','z']);
		$podaci['app']['id']=$slugApp?Input::get('aplikacija'):null;//nalog_id
		$podaci['app']['slug']=$slugApp;
		$podaci['datumOd']=Input::get('datumOd');
		$podaci['datumDo']=Input::get('datumDo');
		$tema=$slugApp?'.'.Tema::find(Nalog::find(Input::get('aplikacija'),['tema_id'])->tema_id, ['slug'])->slug:'-osnove.osnovna';
		$podaci['dodatna_oprema']=DodatnaOprema::get(['id','naziv']);
		return view('aplikacija.teme'.$tema.'.pretraga',compact('podaci'));
	}
}
