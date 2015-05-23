<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Korisnici;
use App\Mailbox;
use App\Nalog;
use App\Newsletter;
use App\OsnovneMetode;
use App\Security;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
class MailboxC extends Controller {
	public function mailbox($slug,$akcija,$username=null){
		$podaci['prava']=$slug;
		$podaci['akcija']=$akcija;
		$podaci['username']=$username;
		if(Security::autentifikacijaTest(4,'min')){
			$podaci['app']=Nalog::where('korisnici_id',Session::get('id'))->lists('naziv','id');
			$podaci['newsKorisniciNum']=OsnovneMetode::brojNewsletterKorisnika();
		}
		return Security::autentifikacija('mailbox.index',compact('podaci'),2,'min');
	}
//POSALJI
	public function getKreiraj($pravaSlug,$username=null){
		return redirect("/{$pravaSlug}/mailbox")->withAkcija('nova')->withUsername($username);
	}
	public function postPosaljiPoruku(){
		if(!Security::autentifikacijaTest(2,'min'))return Security::rediectToLogin();
		$podaci=json_decode(Input::get('podaci'));
		$primalac=Korisnici::where('username',$podaci->za)->get(['id'])->first();
		if(!$primalac) return json_encode(['msg'=>'Došlo je do greške. <b>Ne postoji korisnik sa navedenim username-om.</b>','check'=>0]);
		Mailbox::insert(['korisnici_id'=>$primalac->id,'od_id'=>Session::get('id'),'od_email'=>Korisnici::find(Session::get('id'),['email'])->email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka]);
		Mailbox::insert(['korisnici_id'=>$primalac->id,'od_id'=>Session::get('id'),'od_email'=>Korisnici::find(Session::get('id'),['email'])->email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka,'copy'=>1]);
		return json_encode(['msg'=>'Poruka je uspešno poslata.','check'=>1]);
	}
	public function postPosaljiNewsletter(){
		if(!Security::autentifikacijaTest(4,'min'))return Security::rediectToLogin();
		$podaci=json_decode(Input::get('podaci'));
		$od_email=Korisnici::find(Session::get('id'),['email'])->email;
		foreach(Newsletter::where('nalog_id',$podaci->app)->get()->toArray() as $newsletter){
			//mail($newsletter,$podaci->naslov,$podaci->poruka,'From: '.$od_email);
		}
		Mailbox::insert(['korisnici_id'=>Session::get('id'),'od_id'=>Session::get('id'),'od_email'=>$od_email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka,'copy'=>1]);
		return json_encode(['msg'=>'Poruka je uspešno poslata.','check'=>1]);
	}
	public function postPronadjiUsername(){
		if(!Security::autentifikacijaTest(2,'min'))Security::rediectToLogin();
		return json_encode(Korisnici::where('username','Like','%'.Input::get('tekst').'%')->get(['username','email'])->toArray());
	}
//INBOX
	public function anyIndex($pravaSlug){
		$akcija=Session::has('akcija')?Session::get('akcija'):'inbox';
		$username=Session::has('username')?Session::get('username'):'';
		return $this->mailbox($pravaSlug,$akcija,$username);
	}
	public function getInbox($pravaSlug){
		return $this->mailbox($pravaSlug,'inbox');
	}
	public function postUcitajInbox(){
		if(!Security::autentifikacijaTest(2,'min'))return Security::rediectToLogin();
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.od_id')
			->where('korisnici_id',Session::get('id'))
			->where('mailbox.aktivan',1)
			->where('mailbox.copy',0)
			->orderby('mailbox.created_at','DESC')
			->get(['mailbox.id','od_email','username','naslov','procitano','mailbox.created_at'])->toArray());
	}
	public function postUcitajPoruku(){
		if(!Security::autentifikacijaTest(2,'min'))return Security::rediectToLogin();
		Mailbox::where('id',Input::get('id'))->update(['procitano'=>1]);
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.od_id')->where('korisnici_id',Session::get('id'))->where('mailbox.id',Input::get('id'))->get(['od_email','username','naslov','poruka','procitano','mailbox.created_at'])->first());
	}
//POSLATE
	public function getPoslate($pravaSlug){
		return redirect("/{$pravaSlug}/mailbox")->withAkcija('poslate');
	}
	public function postPoslate(){
		if(!Security::autentifikacijaTest(2,'min'))return Security::rediectToLogin();
		return json_encode(Mailbox::join('korisnici','korisnici.id','=','mailbox.korisnici_id')->where('od_id',Session::get('id'))->where('mailbox.copy',1)->where('mailbox.aktivan',1)->orderby('created_at','DESC')->get(['mailbox.id','korisnici.username','naslov','mailbox.created_at'])->toArray());
	}
	public function postUcitajPoslatu(){
		if(!Security::autentifikacijaTest(2,'min'))return Security::rediectToLogin();
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.korisnici_id')->where('od_id',Session::get('id'))->where('mailbox.id',Input::get('id'))->get(['od_email','username','naslov','poruka','procitano','mailbox.created_at'])->first());
	}
//UKLONI
	public function postUkloniPoruku(){
		if(!Security::autentifikacijaTest(2,'min'))return json_encode(['msg'=>'Greska pri autentifikaciji.','check'=>0]);
		if(Mailbox::where(Input::get('inout')=='inbox'?'korisnici_id':'od_id',Session::get('id'))->where('id',Input::get('id'))->where('copy',Input::get('inout')=='inbox'?0:1)->update(['aktivan'=>0]))
			return json_encode(['msg'=>'Uspešno ste uklonili poruku.','check'=>1]);
		else
			return json_encode(['msg'=>'Desila se greška. ','check'=>0]);
	}
//Newsletter
	public function getNewsletter($pravaSlug){
		if(Security::autentifikacijaTest(4,'min')) return $this->mailbox($pravaSlug,'newsletter');
		return $this->mailbox($pravaSlug,'inbox');
	}
}
