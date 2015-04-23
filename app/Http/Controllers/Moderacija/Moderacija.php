<?php namespace App\Http\Controllers\Moderacija;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Komentari;
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
		$aplikacije=Nalog::join ('korisnici', 'nalog.korisnici_id','=','korisnici.id' )
			->join('tema','nalog.tema_id','=','tema.id')
			->where('korisnici.id',Session::get('id'))
			->get(['nalog.id','nalog.naziv as naziv','nalog.slug','nalog.aktivan','tema.naziv as tema','korisnici.ime'])
			->toArray();
		return Security::autentifikacija('moderacija.aplikacija.index', compact('aplikacije'),4);
	}
	public function getPodesavanja($slug=null){
		$podaci['aplikacije']=$slug?Nalog::where('aktivan',1)->where('korisnici_id',Session::get('id'))->where('slug',$slug)->get(['id','slug','naziv','saradnja','tema_id'])->toArray():Nalog::where('aktivan',1)->where('korisnici_id',Session::get('id'))->get(['id','slug','naziv','saradnja','tema_id'])->toArray();
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
						'naziv'=>'N'.$templejt['id'],
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
	public function getSadrzaji(){
		$temaid=Nalog::where('id',Session::get('id'))->get(['tema_id'])->toArray();
		$podaci=Sadrzaji::join('nalog', 'sadrzaji.nalog_id','=','nalog.id')->where('nalog.tema_id', $temaid)->get(['sadrzaji.id','sadrzaji.naziv as sadrzaj_naziv','sadrzaj','templejt_id','nalog_id'])->toArray();
		return Security::autentifikacija('moderacija.aplikacija.sadrzaji',compact('podaci'),4);
		}
	
	public function postSadrzaji($id){
		if(Security::autentifikacijaTest(4))
		{
				Sadrzaji::find($id)->update(['naziv'=>Input::get('naziv'),'sadrzaj'=>Input::get('sadrzaj')]);
				return Redirect::back();
		}
	return Security::rediectToLogin();
	}

	public function getKomentari(){
		if(Security::autentifikacijaTest(4)){
			$komentari=Komentari::join('sadrzaji','sadrzaji.id','=','komentari.sadrzaji_id')->join('nalog','nalog.id','=','sadrzaji.nalog_id')
				->where('nalog.korisnici_id',Session::get('id'))->get(['komentar','nalog.id'])->toArray();
			dd($komentari);
		}
		return Redirect::back();
	}

	public function getUPripremi(){
		return view('moderacija.u-pripremi.index');
	}
}
