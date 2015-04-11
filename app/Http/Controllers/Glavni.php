<?php namespace App\Http\Controllers;

use App\Grad;
use App\Objekat;
use App\Templejt;

class Glavni extends Controller {

	public function getIndex(){
		$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')
			->where('nalog_id','=',1)->where('tema_id','=',1)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id'])->toArray();
		$podaci['foother']=false;
		$podaci['pozadine']=[
			'teme/osnovna-paralax/slike/15.jpg',//8
			'teme/osnovna-paralax/slike/19.jpg',
			'teme/osnovna-paralax/slike/28.jpg',
			'teme/osnovna-paralax/slike/34.jpg',
		];
		$podaci['icon']=[
			'',
			'glyphicon glyphicon-search',
			'glyphicon glyphicon-calendar',
			'glyphicon glyphicon-earphone',
			''
		];
		$podaci['grad']=Grad::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
		return view('aplikacija.index',compact('podaci'));
	}
	public function getMarkeri(){
		$nalozi=Objekat::join('nalog','nalog.id','=','objekat.nalog_id')->whereNotNull('x')->get(['objekat.id','objekat.naziv','slug','x','y'])->toArray();
		$niz = 'onLoadMarkers({"type": "FeatureCollection","features": [';
		$i=0;
		foreach($nalozi as $nalog){
			if($i==0)$i=1;
			else $niz.=',';
			$niz.='{"id":"'.$nalog['id'].'","slug":"'.$nalog['slug'].'","type":"Feature","geometry":{"type":"Point","coordinates":['.$nalog['y'].','.$nalog['x'].']},"properties":{"crime_type":"'.$nalog['naziv'].'","description":"GRAND THEFT FROM LOCKED AUTO","case_number":"116164029","address":null,"zip_code":null,"beat":null,"accuracy":"9"}}';
		}
        $niz.=']});';
		return $niz;
	}



	

}
