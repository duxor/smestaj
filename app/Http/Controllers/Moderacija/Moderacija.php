<?php namespace App\Http\Controllers\Moderacija;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Komentari;
use App\OsnovneMetode;
use App\Rezervacije;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
use App\Korisnici;
use App\DodatnaOprema;
use App\Dodatno;

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
		$podaci['rezervacije']['aktivne']=Rezervacije::join('smestaj as s','s.id','=','rezervacije.smestaj_id')
			->join('objekat as o','o.id','=','s.objekat_id')
			->join('nalog as n','n.id','=','o.nalog_id')
			->where('n.korisnici_id',Session::get('id'))
			->where('rezervacije.aktivan',1)
			->groupBy('rezervacije.smestaj_id')
			->select(DB::Raw('count(smestaj_rezervacije.id) as brojRezervacija, sum(smestaj_rezervacije.broj_osoba) as ukupnoOsoba, sum(smestaj_rezervacije.cena_ukupna) as uupanPrihod'))
			->first();
		if($podaci['rezervacije']['aktivne'])$podaci['rezervacije']['aktivne']=$podaci['rezervacije']['aktivne']->toArray();
		$podaci['rezervacije']['zakljucene']=Rezervacije::join('smestaj as s','s.id','=','rezervacije.smestaj_id')
			->join('objekat as o','o.id','=','s.objekat_id')
			->join('nalog as n','n.id','=','o.nalog_id')
			->where('n.korisnici_id',Session::get('id'))
			->where('rezervacije.aktivan',0)
			->groupBy('rezervacije.smestaj_id')
			->select(DB::Raw('count(smestaj_rezervacije.id) as brojRezervacija, sum(smestaj_rezervacije.broj_osoba) as ukupnoOsoba, sum(smestaj_rezervacije.cena_ukupna) as uupanPrihod'))
			->first();
		if($podaci['rezervacije']['zakljucene'])$podaci['rezervacije']['zakljucene']=$podaci['rezervacije']['zakljucene']->toArray();
		$podaci['rezervacije']['ukupno']=Rezervacije::join('smestaj as s','s.id','=','rezervacije.smestaj_id')
			->join('objekat as o','o.id','=','s.objekat_id')
			->join('nalog as n','n.id','=','o.nalog_id')
			->where('n.korisnici_id',Session::get('id'))
			->groupBy('rezervacije.smestaj_id')
			->select(DB::Raw('count(smestaj_rezervacije.id) as brojRezervacija, sum(smestaj_rezervacije.broj_osoba) as ukupnoOsoba, sum(smestaj_rezervacije.cena_ukupna) as uupanPrihod'))
			->first();
		if($podaci['rezervacije']['ukupno'])$podaci['rezervacije']['ukupno']=$podaci['rezervacije']['ukupno']->toArray();
		$podaci['newsletter']=OsnovneMetode::brojNewsletterKorisnika();
		$podaci['komentari']=Komentari::join('smestaj as s','s.id','=','komentari.smestaj_id')
			->join('objekat as o','o.id','=','s.objekat_id')
			->join('nalog as n','n.id','=','o.nalog_id')
			->where('n.korisnici_id',Session::get('id'))
			->count('komentari.id');
		$podaci['kapaciteti']['smjestaj']=Smestaj::join('objekat as o','o.id','=','smestaj.objekat_id')
			->join('nalog as n','n.id','=','o.nalog_id')
			->where('n.korisnici_id',Session::get('id'))
			->count('smestaj.id');
		$podaci['kapaciteti']['objekat']=Objekat::join('nalog as n','n.id','=','objekat.nalog_id')
			->where('n.korisnici_id',Session::get('id'))
			->count('objekat.id');
		return Security::autentifikacija('moderacija.aplikacija.index', compact('podaci'),4);
	}
	public function getPodesavanja($slug=null){
		$podaci['aplikacije']=$slug?Nalog::where('aktivan',1)->where('korisnici_id',Session::get('id'))->where('slug',$slug)->get(['id','slug','naziv','saradnja','tema_id','facebook','google','twitter','skype'])->toArray():Nalog::where('aktivan',1)->where('korisnici_id',Session::get('id'))->get(['id','slug','naziv','saradnja','tema_id','facebook','google','twitter','skype'])->toArray();
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
			$app->facebook=Input::get('facebook');
			$app->twitter=Input::get('twitter');
			$app->google=Input::get('google');
			$app->skype=Input::get('skype');
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

	public function getKomentari($svi=null){
		$komentari=Komentari::join('smestaj as s','s.id','=','komentari.smestaj_id')
			->join('objekat as o','o.id','=','s.objekat_id')
			->join('nalog as n','n.id','=','o.nalog_id')
			->join('korisnici as k','k.id','=','komentari.korisnici_id')
			->where('n.korisnici_id',Session::get('id'))
			->where('komentari.aktivan',($svi=='svi'?'>':null).'=',0)
			->get(['komentari.aktivan','komentari.id','komentari.komentar','k.username','s.slug','s.id as id_smestaja'])->toArray();
		return Security::autentifikacija('moderacija.aplikacija.komentari',compact('komentari'),4,'min');
	}
	public function postZabrani(){
		if(!Security::autentifikacijaTest(4,'min')) return json_encode(['msg'=>'Dogodila se greška. Proverite podatke i pokušajte ponovo.','check'=>0]);
		$podaci=json_decode(Input::get('podaci'));
		Komentari::destroy($podaci->id_komentara);
		return json_encode(['msg'=>'Uspešno ste zabranili komentar','check'=>1]);
	}
	public function postOdobri(){
		if(!Security::autentifikacijaTest(4,'min')) return json_encode(['msg'=>'Dogodila se greška. Proverite podatke i pokušajte ponovo.','check'=>0]);
		$podaci=json_decode(Input::get('podaci'));
		Komentari::find($podaci->id_komentara)->update(['aktivan'=>1]);
		return json_encode(['msg'=>'Uspešno ste odobrili komentar','check'=>1]);
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
							->get(['objekat.id','objekat.aktivan','objekat.naziv','objekat.opis','objekat.adresa','vrsta_objekta.naziv as vrsta','grad.naziv as grad','nalog.naziv as nalog'])->toArray();
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
		if(Security::autentifikacijaTest(4,'min')){
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
		$objekti=Smestaj::orderBy('naziv')->where('nalog_id','=',$nal)
						->join('objekat','objekat.id','=','smestaj.objekat_id')
						->join('nalog','nalog.id','=','objekat.nalog_id')
						->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
						->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
							->get(['smestaj.id','smestaj.naziv','nalog.slug as app','smestaj.slug','smestaj.aktivan','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as broj_osoba'])->toArray();
		return Security::autentifikacija('moderacija.objekti.pregled_smestaja',compact('objekti','nalog'),4);
	}
	public function getIzmeniSmestaj($id){
		$kapacitet=Kapacitet::lists('naziv','id');
		$vrstasmestaja=VrstaSmestaja::lists('naziv','id');
		$objekti=Smestaj::where('smestaj.id','=', $id)->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
		->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
		->get(['smestaj.naziv','smestaj.id','vrsta_smestaja.id as id_smestaja','kapacitet.id as id_kapaciteta','smestaj.cena_osoba'])->first()->toArray();
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
		$dodatna_oprema=DodatnaOprema::get()->toArray();	
		return Security::autentifikacija('moderacija.objekti.novi_smestaj',compact('kapacitet','vrstasmestaja','objekti','dodatna_oprema'),4);
	}
	public function postNoviSmestaj(){//dd(Input::all());
		if(Security::autentifikacijaTest(4,'min')){
			$validator=Validator::make([
            'slug'=>Input::get('slug'),
            'cena'=>Input::get('cena')
        	],[
            'slug'=>'required',
            'cena'=>'required|numeric'

        	],[
            'slug.required'=>'Slug je obavezan.',
            'cena.required'=>'Cena je obavezna.',
            'cena.numeric'=>'Cena mora biti broj.'
        	]);
			if($validator->fails())  
     		return redirect()->back()->withGreska($validator->errors()->toArray())->withInput();
			$podaci=Korisnici::where('korisnici.id','=',Session::get('id'))
			->where('objekat.id',Input::get('nazivobjekta'))
			->join('nalog','nalog.korisnici_id','=','korisnici.id')
			->join('objekat','objekat.nalog_id','=','nalog.id')
			->get(['korisnici.username','nalog.slug','objekat.naziv'])->first()->toArray();

			OsnovneMetode::kreirjFolder("galerije/".$podaci['username']."/aplikacije/".$podaci['slug']."/smestaji/".Input::get('slug')."");

			$target_dir="galerije/".$podaci['username']."/aplikacije/".$podaci['slug']."/smestaji/".Input::get('slug')."/";
			$target_file = $target_dir . basename($_FILES["naslovna_foto"]["name"]);
			move_uploaded_file($_FILES["naslovna_foto"]["tmp_name"], $target_file);

            $novi=Smestaj::firstOrNew(['id'=>Input::get('id')]);
            $novi->objekat_id = Input::get('nazivobjekta'); 
            $novi->aktivan = '1';
            $novi->kapacitet_id = Input::get('kapacitet');
            $novi->vrsta_smestaja_id = Input::get('vrstasmestaja');
            $novi->naziv=Input::get('smestaj');
            $novi->cena_osoba = Input::get('cena');
            $novi->slug = Input::get('slug');
            $novi->naslovna_foto="galerije/".$podaci['username']."/aplikacije/".$podaci['slug']."/smestaji/".Input::get('slug')."";
            $novi->save();
            $id=$novi->id;
    
			if(Input::has('oprema_filter'))
			{	
	            foreach ( Input::get('oprema_filter') as $key=>$val)
	            {
	            	$dod=new Dodatno();
	            	$dod->smestaj_id=$id;
	            	$dod->dodatna_oprema_id=$key;
	            	$dod->save();
	            }
        	}
            return Redirect::back()->with('message','Uspešno ste dodali novi smeštaj!');
        }else return Security::rediectToLogin();
		
	}
	public function getZauzeti(){
		$podaci=Nalog::join('objekat as o','o.nalog_id','=','nalog.id')
			->join('smestaj as s','s.objekat_id','=','o.id')
			->join('kapacitet as k','k.id','=','s.kapacitet_id')
			->join('vrsta_smestaja as v','v.id','=','s.vrsta_smestaja_id')
			->join('rezervacije as r','r.smestaj_id','=','s.id')
			->join('korisnici as kk','kk.id','=','r.korisnici_id')
			->where('nalog.korisnici_id',Session::get('id'))
			->whereIn('s.id',function($query){
				$query->select('r.smestaj_id')->from('rezervacije as r')->where('r.od','<=',date('Y-m-d'))->where('r.do','>',date('Y-m-d'));
			})
			->orderBy('r.do')
			->groupBy('r.smestaj_id')
			->get(['s.id','nalog.slug as app','s.naziv','s.slug','k.naziv as kapacitet','v.naziv as vrsta_smestaja','o.naziv as objekat','cena_osoba','r.do as zauzetDo','kk.username as korisnik'])->toArray();
		return Security::autentifikacija('moderacija.objekti.zauzeti',compact('podaci'),4,'min');
	}
	public function getSlobodni(){
		if(!Security::autentifikacijaTest(4,'min'))Security::rediectToLogin();
		$podaci=Nalog::join('objekat as o','o.nalog_id','=','nalog.id')
			->join('smestaj as s','s.objekat_id','=','o.id')
			->join('kapacitet as k','k.id','=','s.kapacitet_id')
			->join('vrsta_smestaja as v','v.id','=','s.vrsta_smestaja_id')
			->leftjoin('rezervacije as r',function($join){
				$join->on('r.smestaj_id','=','s.id')->where('r.od','>',date('Y-m-d'));})
			->where('nalog.korisnici_id',Session::get('id'))
			->whereNotIn('s.id',function($query){
				$query->select('r.smestaj_id')->from('rezervacije as r')->where('r.od','<=',date('Y-m-d'))->where('r.do','>',date('Y-m-d'));
			})
			->orderBy('r.od')
			->groupBy('s.id')
			->select('s.id','nalog.slug as app','s.naziv','s.slug','k.naziv as kapacitet','v.naziv as vrsta_smestaja','o.naziv as objekat','cena_osoba',DB::Raw('min(smestaj_r.od) as od'))->get()->toArray();
		return Security::autentifikacija('moderacija.objekti.slobodni',compact('podaci'),4,'min');
	}
	public function postObjekatStatus(){
		if(!Security::autentifikacijaTest(4,'min')) return json_encode(['msg'=>'Dogodila se greška. Proverite podatke i pokušajte ponovo.','check'=>0]);
		$podaci=json_decode(Input::get('podaci'));
		$objekat=Objekat::join('nalog as n','objekat.nalog_id','=','n.id')->where('n.korisnici_id',Session::get('id'))->where('objekat.id',$podaci->id_objekta)->get(['objekat.id','objekat.aktivan'])->first();
		$objekat->aktivan=$objekat->aktivan?0:1;
		$objekat->save();
		return json_encode(['msg'=>'Uspešno ste postavili status objekta na '.($objekat->aktivan?'aktivan':'neaktivan'),'check'=>1]);
	}
	public function postSmestajStatus(){
		if(!Security::autentifikacijaTest(4,'min')) return json_encode(['msg'=>'Dogodila se greška. Proverite podatke i pokušajte ponovo.','check'=>0]);
		$podaci=json_decode(Input::get('podaci'));
		$objekat=Smestaj::where('smestaj.id',$podaci->id_objekta)->get(['smestaj.id','smestaj.aktivan'])->first();
		$objekat->aktivan=$objekat->aktivan?0:1;
		$objekat->save();
		return json_encode(['msg'=>'Uspešno ste postavili status smeštaja na '.($objekat->aktivan?'aktivan':'neaktivan'),'check'=>1]);
	}
	public function postOdgovor(){
		if(Security::autentifikacijaTest(4,'min')){
			$kom=new Komentari();
			$kom->komentar=Input::get('odgovor');
			$kom->korisnici_id=Session::get('id');
			$kom->smestaj_id=Input::get('smestaj_id');
			$kom->aktivan=1;
			$kom->odgovor_za_id=Input::get('id');
			$kom->save();
			Komentari::where('id',Input::get('id'))->update(['aktivan'=>1]);
			return Redirect::back()->with('message','Uspešno ste odgovorili!');
		}else return Security::rediectToLogin();
	}
	

}