<?php namespace App\Http\Controllers\Moderacija;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Security;
use App\Tema;
use App\Nalog;
use App\Templejt;
use App\Sadrzaji;


class Moderacija extends Controller {
	public function getIndex(){
		$nalozi=Nalog::join ('korisnici', 'nalog.korisnici_id','=','korisnici.id' )
			->join('tema','nalog.tema_id','=','tema.id')
			->select('nalog.id','nalog.naziv as naziv','nalog.slug','nalog.aktivan','tema.naziv as tema','korisnici.ime')
			->get()->toArray();
		return Security::autentifikacija('moderacija.aplikacija.index', compact('nalozi'),4);
	}
	public function getPodesavanja(){
		$podaci['aplikacije']=Nalog::where('aktivan',1)->where('korisnici_id',Session::get('id'))->get(['id','slug','naziv','saradnja','tema_id'])->toArray();
		$podaci['teme']=Tema::where('id','<>',1)->where('aktivan',1)->lists('naziv','id');
		foreach($podaci['aplikacije'] as $k=>$app){
			$podaci['aplikacije'][$k]['teme']=Tema::join('templejt','templejt.tema_id','=','tema.id')
				->join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('sadrzaji.nalog_id',$app['id'])->select('tema.naziv as _n','tema.id as _i')->lists('_n','_i');
		}
		return Security::autentifikacija('moderacija.aplikacija.podesavanja',compact('podaci'),4);
	}
	public function postPodesavanja(){
		if(Security::autentifikacijaTest(4)){
			$app=Nalog::find(Input::get('nalog_id'));
			$app->naziv=Input::get('naziv');
			$app->tema_id=Input::get('tema');
			$app->saradnja=Input::get('saradnja');
			$app->save();
			if(!Sadrzaji::join('templejt','templejt.id','=','sadrzaji.templejt_id')->where('nalog_id',$app->id)->where('tema_id',$app->tema_id)->exists()){
				$templejti=Templejt::where('tema_id',$app->tema_id)->get(['id','slug'])->toArray();
				foreach($templejti as $templejt)
					Sadrzaji::insert([
						'naziv'=>$templejt['slug'].'-naziv',
						'sadrzaj'=>'Tekst je u pripremi',
						'templejt_id'=>$templejt['id'],
						'nalog_id'=>$app->id]);
			}
			return Redirect::back();
		}
		return Security::rediectToLogin();	
	
	}
	public function postPrenos(){
		if(Security::autentifikacijaTest(4)){
			$iz=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('tema_id',Input::get('temaiz'))->get(['slug','naziv','sadrzaj'])->toArray();
			foreach($iz as $templejt){
				DB::table('sadrzaji')->join('templejt','templejt.id','=','sadrzaji.templejt_id')
					->where('slug',$templejt['slug'])
					->where('tema_id',Input::get('temau'))
					->where('nalog_id',Input::get('nalog_id'))->update(['sadrzaji.naziv'=>$templejt['naziv'],'sadrzaji.sadrzaj'=>$templejt['sadrzaj']]);
			}
		}
		return Redirect::back();
	}



}
