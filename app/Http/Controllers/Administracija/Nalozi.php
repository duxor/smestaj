<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Nalog;
use App\OsnovneMetode;
use App\Sadrzaji;
use App\Korisnici;
use App\Security;
use App\Tema;
use App\Templejt;
use App\VrstaSadrzaja;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Nalozi extends Controller {

	public function getIndex(){

		$nalozi=Nalog::join ('korisnici', 'nalog.korisnici_id','=','korisnici.id' )->
		join('tema','nalog.tema_id','=','tema.id')->select('nalog.naziv as naziv','nalog.slug','nalog.aktivan','tema.naziv as tema','korisnici.ime')->
		get()->toArray();
		
		return Security::autentifikacija('administracija.nalog.index', compact('nalozi'));
	}
	public function getNalogEdit($slug){
		$nalog=Nalog::where('slug','=',$slug)->get(['id','naziv', 'slug', 'aktivan', 'created_at', 'updated_at','korisnici_id','tema_id'])->first()->toArray();
		$lista = array('' => '') +  Korisnici::where('pravapristupa_id','>','3')->lists('ime', 'id');
		$tema=Tema::lists('naziv','id');
		return Security::autentifikacija('administracija.nalog.edit', compact('nalog','lista','tema'));
	}

	public function getNalogNovi(){
		$kor = array('' => '') + Korisnici::where('pravapristupa_id','>','3')->lists('ime', 'id');
		$tema= Tema::lists('naziv','id');
		return Security::autentifikacija('administracija.nalog.edit', compact('kor','tema'));

	}

	public function postNalogNovi(){
		if(Security::autentifikacijaTest()){
			$nalog= Nalog::firstOrNew(['id'=>Input::get('id')],['id','naziv','slug' ,'pridruzi','tema']);  
			$nalog->naziv=Input::get('naziv');
			$nalog->slug=Input::get('slug');
			$nalog->korisnici_id=Input::get('pridruzi');
			$nalog->tema_id=Input::get('tema');;
			$nalog->save();
			return redirect('/administracija/nalog');
		}
		return Security::rediectToLogin();
	}

	public function getNalogActive($naziv){
        if(Security::autentifikacijaTest()){
            $nalog = Nalog::where('naziv','=',$naziv)->get(['id','aktivan'])->first();
            $nalog->aktivan = $nalog->aktivan ? 0 : 1;
            $nalog->save();
            return Redirect::back();
        }
        return Security::rediectToLogin();
    }
    public function getNalogBrisi($slug){
		if(Security::autentifikacijaTest()){
			Nalog::where('slug','=',$slug)->delete();
			return redirect('/administracija/nalog');
		}
		return Security::rediectToLogin();
	}



}