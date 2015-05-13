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
use App\Objekat;
use App\VrstaObjekta;
use App\Grad;
use App\Smestaj;
use App\VrstaSmestaja;
use App\Kapacitet;


class Moderacija extends Controller {
	public function getRefresh(){
		return Redirect::back();
	}
	public function getIndex(){
		$podaci['aplikacije']=Nalog::join ('korisnici', 'nalog.korisnici_id','=','korisnici.id')
			->join('tema','nalog.tema_id','=','tema.id')
			->where('korisnici.id',Session::get('id'))
			->get(['nalog.id','nalog.naziv as naziv','nalog.slug','nalog.aktivan','tema.naziv as tema','korisnici.ime'])
			->toArray();
		return Security::autentifikacija('moderacija.aplikacija.index', compact('podaci'),4);
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
	public function anySadrzaji($appSlug=null){
		if($appSlug) {
			$podaci['sadrzaji'] = Nalog::join('sadrzaji', 'sadrzaji.nalog_id', '=', 'nalog.id')
				->join('templejt', 'templejt.id', '=', 'sadrzaji.templejt_id')
				->where('nalog.slug', $appSlug)
				->where('nalog.korisnici_id', Session::get('id'))
				->where('templejt.vrsta_sadrzaja_id','<',6)
				->get(['sadrzaji.id', 'sadrzaji.naziv as sadrzaj_naziv', 'sadrzaj', 'templejt_id', 'nalog_id', 'templejt.vrsta_sadrzaja_id'])->toArray();
			$podaci['pozadine'] = Nalog::join('sadrzaji', 'sadrzaji.nalog_id', '=', 'nalog.id')
				->join('templejt', 'templejt.id', '=', 'sadrzaji.templejt_id')
				->where('nalog.slug', $appSlug)
				->where('nalog.korisnici_id', Session::get('id'))
				->where('templejt.vrsta_sadrzaja_id',6)
				->get(['sadrzaji.id', 'sadrzaji.naziv as sadrzaj_naziv', 'sadrzaj', 'templejt_id', 'nalog_id', 'templejt.vrsta_sadrzaja_id'])->toArray();
			$podaci['app']=Nalog::join('tema','tema.id','=','nalog.tema_id')->where('nalog.slug',$appSlug)->get(['tema.slug as tema','nalog.slug'])->first()->toArray();
		}
		$podaci['aplikacije']=Nalog::where('korisnici_id',Session::get('id'))->lists('naziv','slug');
		$podaci['aplikacije']=array_merge(['0'=>'Izaberite aplikaciju'],$podaci['aplikacije']);
		return Security::autentifikacija('moderacija.aplikacija.sadrzaji',compact('podaci'),4);
	}
	
	public function postSadrzajiUpdate($id,$ajax=null){
		if(Security::autentifikacijaTest(4)){
			if(Input::has('naziv'))
				Sadrzaji::find($id)->update(['naziv'=>Input::get('naziv'),'sadrzaj'=>Input::get('sadrzaj')]);
			else
				Sadrzaji::find($id)->update(['sadrzaj'=>Input::get('sadrzaj')]);
			return $ajax?'Uspešno ste izvršili izmenu.':Redirect::back();
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
	public function getPregled(){
		$nalog=Nalog::where('korisnici_id','=',Session::get('id'))->where('aktivan','=','1')->lists('naziv','id');
		return Security::autentifikacija('moderacija.objekti.pregled', compact('objekti','nalog'),4);
	}
	public function postPregledobjekata(){
		$nal=Input::get('nalog');
		$nalog=Nalog::where('korisnici_id','=',Session::get('id'))->where('aktivan','=','1')->lists('naziv','id');
		$objekti=Objekat::where('nalog_id','=',$nal)->join('vrsta_objekta','vrsta_objekta.id','=','objekat.vrsta_objekta_id')
							->join('grad','grad.id','=','objekat.grad_id')
							->join('nalog','nalog.id','=','objekat.nalog_id')
							->get(['objekat.id','objekat.naziv','objekat.opis','objekat.adresa','vrsta_objekta.naziv as vrsta','grad.naziv as grad','nalog.naziv as nalog'])->toArray();
		return Security::autentifikacija('moderacija.objekti.pregled_objekata', compact('objekti','nalog'),4);
	}
	public function getIzmeniObjekat($id){
		$vrstaobjekta=VrstaObjekta::lists('naziv','id');
		$grad=Grad::lists('naziv','id');
		$nalog=Nalog::where('korisnici_id','=',Session::get('id'))->where('aktivan','=','1')->lists('naziv','id');
		$objekti=Objekat::where('id','=',$id)->get(['id','naziv as ime','opis as opis_objekta','x','y','z','adresa','vrsta_objekta_id','grad_id','nalog_id'])->first()->toArray();
		return Security::autentifikacija('moderacija.objekti.edit_objekta',
				compact('vrstaobjekta','grad','nalog','objekti'), 4);	
	}
	public function postIzmeniObjekat(){
		if(Security::autentifikacijaTest(4)){
			Objekat::find(Input::get('id'))->update(['naziv'=>Input::get('nazivobjekta'),'opis'=>Input::get('opisobjekta'),
									'x'=>Input::get('x'),'y'=>Input::get('y'),'z'=>Input::get('z'),'adresa'=>Input::get('adresa'),
									'vrsta_objekta_id'=>Input::get('vrstaobjekta'),'grad_id'=>Input::get('grad'),'nalog_id'=>Input::get('nalog')]);
			return Redirect::back()->with('message','Uspešno ste izmenili objekat!');
		}
		return Security::rediectToLogin();	
	}
	public function getNoviObjekat(){
		$vrstaobjekta=VrstaObjekta::lists('naziv','id');
		$grad=Grad::lists('naziv','id');
		$nalog=Nalog::where('korisnici_id','=',Session::get('id'))->where('aktivan','=','1')->lists('naziv','id');
		return Security::autentifikacija('moderacija.objekti.novi',compact('vrstaobjekta','grad','nalog'),4);
	}
	public function postNoviObjekat(){
		 if(Security::autentifikacijaTest(4)){
            $novi = Objekat::firstOrNew(['id'=>Input::get('id')]);
            $novi->naziv = Input::get('nazivobjekta'); 
            $novi->opis = Input::get('opisobjekta');
            $novi->x = Input::get('x');
            $novi->y = Input::get('y');
            $novi->z = Input::get('z');
            $novi->adresa = Input::get('adresa');
            $novi->vrsta_objekta_id = Input::get('vrstaobjekta');
            $novi->grad_id = Input::get('grad');
            $novi->nalog_id = Input::get('nalog');
            $novi->save();
            return Redirect::back()->with('message','Uspešno ste dodali novi objekat!');
        }else return Security::rediectToLogin();		
	}

	public function getSmestaj(){
		$nalog=Nalog::where('korisnici_id','=',Session::get('id'))->where('aktivan','=','1')->lists('naziv','id');
		return Security::autentifikacija('moderacija.objekti.smestaj', compact('nalog'),4);
	}
	public function postPregledSmestaja(){
		$nal=Input::get('nalog');
		$nalog=Nalog::where('korisnici_id','=',Session::get('id'))->where('aktivan','=','1')->lists('naziv','id');
		$objekti=Smestaj::orderBy('naziv')->where('nalog_id','=',$nal)->join('objekat','objekat.id','=','smestaj.objekat_id')
						->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
						->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
							->get(['smestaj.id','smestaj.naziv','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as broj_osoba'])->toArray();
		return Security::autentifikacija('moderacija.objekti.pregled_smestaja',compact('objekti','nalog'),4);
	}
	public function getIzmeniSmestaj($id){
		$kapacitet=Kapacitet::lists('naziv','id');
		$vrstasmestaja=VrstaSmestaja::lists('naziv','id');
		$objekti=Smestaj::where('smestaj.id','=', $id)->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
		->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
		->get(['smestaj.naziv','smestaj.id','vrsta_smestaja.id as id_smestaja','kapacitet.id as id_kapaciteta'])->first()->toArray();
		return Security::autentifikacija('moderacija.objekti.edit_smestaja',
				compact('kapacitet','vrstasmestaja','objekti'), 4);	
	}
	public function postIzmeniSmestaj(){
		if(Security::autentifikacijaTest(4)){
			Smestaj::find(Input::get('id'))->update(['vrsta_smestaja_id'=>Input::get('vrstasmestaja'),'kapacitet_id'=>Input::get('kapacitet')]);
			return Redirect::back()->with('message','Uspešno ste izmenili smeštaj!');
		}
		return Security::rediectToLogin();	
	
	}
	public function getNoviSmestaj(){
		$kapacitet=Kapacitet::lists('naziv','id');
		$vrstasmestaja=VrstaSmestaja::lists('naziv','id');
		$objekti=Nalog::where('korisnici_id','=',Session::get('id'))->where('nalog.aktivan','=','1')
						->join('objekat','objekat.nalog_id','=','nalog.id')
						->get(['objekat.naziv as naziv_objekta','objekat.id'])->lists('naziv_objekta','id');
					
		return Security::autentifikacija('moderacija.objekti.novi_smestaj',compact('kapacitet','vrstasmestaja','objekti'),4);
	}
	public function postNoviSmestaj(){
		if(Security::autentifikacijaTest(4)){
			$naziv_objekta=Objekat::where('id','=',Input::get('nazivobjekta'))->get(['naziv'])->first()->toArray();
            $novi = Smestaj::firstOrNew(['id'=>Input::get('id')]);
            $novi->objekat_id = Input::get('nazivobjekta'); 
            $novi->aktivan = '1';
            $novi->kapacitet_id = Input::get('kapacitet');
            $novi->vrsta_smestaja_id = Input::get('vrstasmestaja');
            $novi->naziv= $naziv_objekta['naziv'];
            $novi->cena_osoba = Input::get('cena');
            $novi->save();
            return Redirect::back()->with('message','Uspešno ste dodali novi smeštaj!');
        }else return Security::rediectToLogin();
		
	}
}