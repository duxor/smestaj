<?php namespace App\Http\Controllers;

use App\Grad;
use App\Nalog;
use App\Objekat;
use App\Templejt;
use Illuminate\Support\Facades\Input;

class Glavni extends Controller {

	public function getIndex($slug=null){

	}
	public function getMarkeriGradovi(){dd(1);
		$nalozi=Grad::whereNotNull('x')->get(['id','naziv','x','y']);
		$niz = 'onLoadMarkers({"type": "FeatureCollection","features": [';
		$i=0;
		if($nalozi){dd($nalozi);
			$nalozi=$nalozi->toArray();
			foreach($nalozi as $nalog){
				if($i==0)$i=1;
				else $niz.=',';
				$niz.='{"id":"'.$nalog['id'].'","type":"Feature","geometry":{"type":"Point","coordinates":['.$nalog['x'].','.$nalog['y'].']},"properties":{"naslov":"'.$nalog['naziv'].'","description":null,"case_number":null,"address":null,"zip_code":null,"beat":null,"accuracy":"9"}}';
			}
		}
        $niz.=']});';
		return $niz;
	}



	

}
