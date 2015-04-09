<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Nalog;
use App\OsnovneMetode;
use App\Korisnici;
use App\Sadrzaji;
use App\Security;
use App\Tema;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Nalozi extends Controller {

	public function getIndex(){
		$nalozi=Nalog::join ('korisnici', 'nalog.korisnici_id','=','korisnici.id' )
			->join('tema','nalog.tema_id','=','tema.id')
			->select('nalog.id','nalog.naziv as naziv','nalog.slug','nalog.aktivan','tema.naziv as tema','korisnici.ime')
			->get()->toArray();
		return Security::autentifikacija('administracija.nalog.index', compact('nalozi'),5);
	}
	public function getNalogEdit($slug){
		$nalog=Nalog::where('slug',$slug)->get(['id','naziv','slug','korisnici_id','tema_id'])->first()->toArray();
		$korisnici = Korisnici::where('pravapristupa_id','>','3')->lists('username', 'id');
		$tema_id=Tema::lists('naziv','id');
		return Security::autentifikacija('administracija.nalog.edit', compact('nalog','korisnici','tema_id'),5);
	}
	public function postNalogEdit(){
		if(Security::autentifikacijaTest(5)){
			$nalog= Nalog::firstOrNew(['id'=>Input::get('id')],['id','naziv','slug','korisnici_id','tema_id']);
			$nalog->naziv=Input::get('naziv');
			$nalog->slug=Input::get('slug');
			$nalog->korisnici_id=Input::get('korisnici_id');
			$nalog->tema_id=Input::get('tema_id');;
			$nalog->save();
			return redirect('/administracija/nalog');
		}
		return Security::rediectToLogin();
	}
	public function getNalogNovi(){
		$korisnici = Korisnici::where('pravapristupa_id','>','3')->lists('username','id');
		$tema_id= Tema::lists('naziv','id');
		return Security::autentifikacija('administracija.nalog.edit',compact('korisnici','tema_id'),5);
	}
	public function getNalogStatus($id){
        if(Security::autentifikacijaTest(5)){
            $nalog = Nalog::find($id,['id','aktivan']);
            $nalog->aktivan = $nalog->aktivan ? 0 : 1;
            $nalog->save();
            return Redirect::back();
        }
        return Security::rediectToLogin();
    }
    public function getNalogBrisi($id){
		if(Security::autentifikacijaTest(5)){
			Nalog::destroy($id);
			return redirect('/administracija/nalog');
		}
		return Security::rediectToLogin();
	}
	public function getSadrzaji($slug){
		$podaci['sadrzaji']=Sadrzaji::join('nalog','sadrzaji.nalog_id','=','nalog.id')->where('nalog.slug',$slug)->get(['nalog.slug','nalog.naziv as nalog_naziv','sadrzaji.naziv as sadrzaj_naziv','sadrzaj','templejt_id','nalog_id']);
		return Security::autentifikacija('administracija.nalog.pregled',compact('podaci'),5);
	}


}