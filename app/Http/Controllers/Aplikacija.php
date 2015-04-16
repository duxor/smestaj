<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Nalog;
use App\Templejt;
use App\Grad;

class Aplikacija extends Controller {
	public function getIndex($slug=null){
		if(!$slug){
			$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','<>',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();
			$podaci['pocetna']=true;
			$podaci['pozadine']=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','=',6)->orderBy('redoslijed')->get(['sadrzaj'])->toArray();
			$podaci['grad']=Grad::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
			return view('aplikacija.teme-osnove.osnovna.index',compact('podaci'));
		}
		//#######################
		$nalog=Nalog::join('tema','tema.id','=','nalog.tema_id')->where('nalog.slug',$slug)->where('nalog.aktivan',1)->get(['nalog.id','tema_id','nalog.naziv','nalog.slug as nalog_slug','tema.slug as tema_slug'])->first()->toArray();
		if($nalog){
			$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id',$nalog['id'])->where('tema_id',$nalog['tema_id'])->where('vrsta_sadrzaja_id','<>',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();
			$podaci['pocetna']=true;
			$podaci['pozadine']=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','=',6)->orderBy('redoslijed')->get(['sadrzaj'])->toArray();
			$podaci['grad']=Grad::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
			//#######################
			return view("aplikacija.teme.{$nalog['tema_slug']}.index",compact('podaci'));
		}else return 'Greska!!!';
		//return "Dobor došli na <b>{$nalog['naziv']}</b> platformu. SLUG:{$nalog['nalog_slug']},TEMA:{$nalog['tema_id']}";
	}
	public function getObjekat($slug){
		return $slug;
	}
}
