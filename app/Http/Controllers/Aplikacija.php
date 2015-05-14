<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Korisnici;
use App\ListaZelja;
use App\Mailbox;
use App\Nalog;
use App\Sadrzaji;
use App\Smestaj;
use App\Templejt;
use App\Grad;
use App\Security;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class Aplikacija extends Controller {
	public function nalog($slugApp){return Nalog::join('tema','tema.id','=','nalog.tema_id')->where('nalog.slug',$slugApp)->where('nalog.aktivan',1)->get(['nalog.id','tema_id','nalog.naziv','nalog.slug as nalog_slug','tema.slug as tema_slug'])->first();}
	public function templejt($nalog){return Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id',$nalog['id'])->where('tema_id',$nalog['tema_id'])->where('vrsta_sadrzaja_id','<',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();}
	public function pozadine($nalog){return Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id',$nalog['id'])->where('tema_id',$nalog['tema_id'])->where('vrsta_sadrzaja_id',6)->orderBy('redoslijed')->get(['sadrzaj'])->toArray();}

	public function getIndex($slug=null){
		if(!$slug){//Osnovna
			$podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','<>',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();
			$podaci['pocetna']=true;
			$podaci['pozadine']=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','=',6)->orderBy('redoslijed')->get(['sadrzaj'])->toArray();
			$podaci['grad']=Grad::orderBy('id')->get(['id','naziv'])->lists('naziv','id');
			return view('aplikacija.teme-osnove.osnovna.index',compact('podaci'));
		}
		//####################### Mod App
		$nalog=$this->nalog($slug);
		if($nalog){
			$nalog=$nalog->toArray();
			$podaci=$this->templejt($nalog);
			$podaci['pocetna']=true;
			$podaci['pozadine']=$this->pozadine($nalog);
			$podaci['grad']=Grad::join('objekat','objekat.grad_id','=','grad.id')->where('objekat.nalog_id',$nalog['id'])->orderBy('grad.id')->get(['grad.id','grad.naziv'])->lists('naziv','id');
			$podaci['app']['id']=$nalog['id'];
			$podaci['app']['slug']=$slug;
			return view("aplikacija.teme.{$nalog['tema_slug']}.index",compact('podaci'));
		}else return'Aplikacija nije aktivna!';
	}
	public function getSmestaj($slugApp,$slugSmestaj){
		$podaci=Sadrzaji::join('templejt','templejt.id','=','sadrzaji.templejt_id')->join('nalog','nalog.id','=','sadrzaji.nalog_id')->where('nalog.slug',$slugApp)->where('vrsta_sadrzaja_id','<',6)->get(['templejt.slug','sadrzaji.naziv','sadrzaji.icon','vrsta_sadrzaja_id'])->toArray();
		$podaci['pozadine']=$this->pozadine($this->nalog($slugApp));
		$podaci['smestaj']=Smestaj::join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
			->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
			->join('objekat','objekat.id','=','smestaj.objekat_id')
			->where('slug',$slugSmestaj)
			->get(['smestaj.naziv','slug','kapacitet.naziv as naziv_kapaciteta','broj_osoba','vrsta_smestaja.naziv as vrsta_smestaja','naslovna_foto','cena_osoba','x','y','z'])->first()->toArray();
		$tema=Nalog::join('tema','tema.id','=','nalog.tema_id')->where('nalog.slug',$slugApp)->get(['tema.slug','nalog.id'])->first();
		$podaci['app']['slug']=$slugApp;
		$podaci['app']['id']=$tema->id;//=nalog.id=appID
		return view("aplikacija.teme.{$tema->slug}.smestaj",compact('podaci'));
	}
	public function postListaZeljaDodaj(){
		if(Input::get('zelja'))
		if(Input::get('zelja')=="false") {
			$lista=new ListaZelja();
			$lista->smestaj_id=Input::get('smestaj');
			$lista->korisnici_id=Input::get('korisnik');
			$lista->save();
			return $lista->id;
		}else return ListaZelja::where('korisnici_id',Session::get('id'))->where('id',Input::get('zelja'))->update(['aktivan'=>0]);
	}
	public function getListaZelja(){
		$lista_zelja=ListaZelja::where('korisnici_id','=',Session::get('id'))
						->where('lista_zelja.aktivan','=','1')
						->join('smestaj','smestaj.id','=','lista_zelja.smestaj_id')
						->join('objekat','objekat.id','=','smestaj.objekat_id')
						->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
						->join('kapacitet','kapacitet.id','=','smestaj.kapacitet_id')
						->get(['smestaj.id','smestaj.naziv','objekat.naziv as naziv_objekta',
							'vrsta_smestaja.naziv as naziv_smestaja','kapacitet.naziv as naziv_kapaciteta','kapacitet.broj_osoba as broj_osoba'])->toArray();
		return view('korisnik.lista-zelja',compact('lista_zelja'));
	}
	public function postKontaktirajAdministraciju(){
		$podaci=json_decode(Input::get('podaci'));
		$validator=Validator::make([
			'prezime'=>$podaci->prezime,
			'ime'=>$podaci->ime,
			'email'=>$podaci->email,
			'poruka'=>$podaci->poruka
		],[
			'prezime'=>'required|min:4|alpha',
			'ime'=>'required|min:3|alpha',
			'email'=>'required|email',
			'poruka'=>'required|min:5'
		],[
			//prezime
			'prezime.required'=>'Obavezan unos prezimena.',
			'prezime.min'=>'Minimalna duzina prezimena je :min.',
			'prezime.alfa'=>'Prezime može da sadrži samo znake alfabeta.',
			//ime
			'ime.required'=>'Obavezan unos imena.',
			'ime.min'=>'Minimalna duzina imena je :min.',
			'ime.alfa'=>'Ime može da sadrži samo znake alfabeta.',
			//email
			'email.email'=>'Pogrešno unesen email.',
			'email.required'=>'Obavezan unos email-a.',
			//poruka
			'poruka.required'=>'Obavezan unos poruke.',
			'poruka.min'=>'Minimalna duzina poruke je :min.'
		]);
		if($validator->fails()){
			$msg='<p>Dogodila se greška: <br><ol>';
			foreach($validator->errors()->toArray() as $greske)
				foreach($greske as $greska)
					$msg.='<li>'.$greska.'</li>';
			$msg.='</ol>';
			return json_encode(['msg'=>$msg,'check'=>0]);
		}
		$mail=new Mailbox();
		if($podaci->user){ $userId=Korisnici::where('username',$podaci->user)->get(['id'])->id; if($userId) $mail->od_id=$userId; }
		$mail->od_email=$podaci->email;
		$mail->naslov='SA SAJTA '.(isset($podaci->kome)?'('.$podaci->kome.')':null);
		$mail->poruka=$podaci->poruka;
		$mail->korisnici_id=2;
		$mail->save();
		return json_encode(['msg'=>'Poruka uspešno poslata. Hvala.','check'=>1]);
	}
	public function postKontaktirajModeratora(){
		$podaci=json_decode(Input::get('podaci'));
		$validator=Validator::make([
			'prezime'=>$podaci->prezime,
			'ime'=>$podaci->ime,
			'email'=>$podaci->email,
			'telefon'=>$podaci->telefon,
			'poruka'=>$podaci->poruka
		],[
			'prezime'=>'required|min:4|alpha',
			'ime'=>'required|min:3|alpha',
			'email'=>'required|email',
			'telefon'=>'numeric',
			'poruka'=>'required|min:5'
		],[
			//prezime
			'prezime.required'=>'Obavezan unos prezimena.',
			'prezime.min'=>'Minimalna duzina prezimena je :min.',
			'prezime.alfa'=>'Prezime može da sadrži samo znake alfabeta.',
			//ime
			'ime.required'=>'Obavezan unos imena.',
			'ime.min'=>'Minimalna duzina imena je :min.',
			'ime.alfa'=>'Ime može da sadrži samo znake alfabeta.',
			//email
			'email.email'=>'Pogrešno unesen email.',
			'email.required'=>'Obavezan unos email-a.',
			//telefon
			'telefon.numeric'=>'Telefon treba da se sastoji samo iz brojeva.',
			//poruka
			'poruka.required'=>'Obavezan unos poruke.',
			'poruka.min'=>'Minimalna duzina poruke je :min.'
		]);
		if($validator->fails()){
			$msg='<p>Dogodila se greška: <br><ol>';
			foreach($validator->errors()->toArray() as $greske)
				foreach($greske as $greska)
					$msg.='<li>'.$greska.'</li>';
			$msg.='</ol>';
			return json_encode(['msg'=>$msg,'check'=>0]);
		}
		$mail=new Mailbox();
		$mail->od_id=isset($podaci->korisnik)?$podaci->korisnik:null;
		$mail->korisnici_id=Nalog::find($podaci->app,['korisnici_id'])->korisnici_id;
		$mail->od_email=$podaci->email;
		$mail->naslov='PORUKA SA SAJTA';
		$mail->poruka=$podaci->poruka;
		$mail->telefon=$podaci->telefon;
		$mail->save();
		return json_encode(['msg'=>'Poruka uspešno poslata. Hvala.','check'=>1]);
	}
}
