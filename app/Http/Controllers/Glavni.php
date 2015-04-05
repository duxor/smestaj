<?php namespace App\Http\Controllers;

use App\Templejt;

class Glavni extends Controller {

	public function getIndex(){
		$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')
			->where('nalog_id','=',1)->where('tema_id','=',1)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id'])->toArray();
		$podaci['foother']=false;
		$podaci['pozadine']=[
			'teme/osnovna-paralax/slike/1.jpg',
			'teme/osnovna-paralax/slike/2.jpg',
			'teme/osnovna-paralax/slike/3.jpg',
			'teme/osnovna-paralax/slike/4.jpg',
			'teme/osnovna-paralax/slike/5.jpg',
			'teme/osnovna-paralax/slike/6.jpg',
			'teme/osnovna-paralax/slike/7.jpg',
			'teme/osnovna-paralax/slike/78.jpg',
		];
		$podaci['icon']=[
			''
		];
		return view('aplikacija.index',compact('podaci'));
	}

}
