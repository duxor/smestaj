<?php namespace App\Http\Controllers\Moderacija;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sadrzaji;
use App\Security;
use App\Nalog;
use Illuminate\Support\Facades\Session;
use App\OsnovneMetode;

class Galerija extends Controller {
	public function getIndex($slugApp,$slugGalerija){
		if(!Nalog::where('slug',$slugApp)->where('korisnici_id',Session::get('id'))->get(['id'])->id)return'Greska!';

		$galerije=Sadrzaji::
			join('nalog','nalog.id','=','sadrzaji.nalog_id')
			->join('templejt','templejt.id','=','sadrzaji.templejt_id')
			->where('nalog.korisnici_id',Session::get('id'))
			->where('templejt.vrsta_sadrzaja_id','=',7)
			->get(['naslov','slug','sadrzaj','aktivan'])->toArray();
		foreach($galerije as $k => $galerija)
			$galerije[$k]['slike'] = OsnovneMetode::listaFotografija("/galerije/".Session::get('username')."/{$slugApp}");
		return Security::autentifikacija('stranice.administracija.galerije', compact('galerije'));
	}
}
