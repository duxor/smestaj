<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Korisnici;
use App\Mailbox;
use App\Security;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
class MailboxC extends Controller {
	public function mailbox($slug,$akcija){
		$podaci['prava']=$slug;
		$podaci['akcija']=$akcija;
		return Security::autentifikacija('mailbox.index',compact('podaci'));
	}
//POSALJI
	public function getKreiraj($pravaSlug){
		return redirect("/{$pravaSlug}/mailbox")->withAkcija('nova');
	}
	public function postPosaljiPoruku(){
		$podaci=json_decode(Input::get('podaci'));
		$primalac=Korisnici::where('username',$podaci->za)->get(['id'])->first();
		if(!$primalac) return json_encode(['msg'=>'Došlo je do greške. <b>Ne postoji korisnik sa navedenim username-om.</b>','check'=>0]);
		Mailbox::insert(['korisnici_id'=>$primalac->id,'od_id'=>Session::get('id'),'od_email'=>Korisnici::find(Session::get('id'),['email'])->email,'naslov'=>$podaci->naslov,'poruka'=>$podaci->poruka]);
		return json_encode(['msg'=>'Poruka je uspešno poslata.','check'=>1]);
	}
//INBOX
	public function anyIndex($pravaSlug){
		$akcija=Session::has('akcija')?Session::get('akcija'):'inbox';
		return $this->mailbox($pravaSlug,$akcija);
	}
	public function getInbox($pravaSlug){
		return $this->mailbox($pravaSlug,'inbox');
	}
	public function postUcitajInbox(){
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.od_id')
			->where('korisnici_id',Session::get('id'))
			->orderby('mailbox.created_at','DESC')
			->get(['mailbox.id','od_email','username','naslov','procitano','mailbox.created_at'])->toArray());
	}
	public function postUcitajPoruku(){
		if(!Security::autentifikacijaTest())return Security::rediectToLogin();
		Mailbox::where('id',Input::get('id'))->update(['procitano'=>1]);
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.od_id')->where('korisnici_id',Session::get('id'))->where('mailbox.id',Input::get('id'))->get(['od_email','username','naslov','poruka','procitano','mailbox.created_at'])->first());
	}
//POSLATE
	public function getPoslate($pravaSlug){
		return redirect("/{$pravaSlug}/mailbox")->withAkcija('poslate');
	}
	public function postPoslate(){
		return json_encode(Mailbox::join('korisnici','korisnici.id','=','mailbox.korisnici_id')->where('od_id',Session::get('id'))->orderby('created_at','DESC')->get(['mailbox.id','korisnici.username','naslov','mailbox.created_at'])->toArray());
	}
	public function postUcitajPoslatu(){
		if(!Security::autentifikacijaTest())return Security::rediectToLogin();
		return json_encode(Mailbox::leftjoin('korisnici','korisnici.id','=','mailbox.korisnici_id')->where('od_id',Session::get('id'))->where('mailbox.id',Input::get('id'))->get(['od_email','username','naslov','poruka','procitano','mailbox.created_at'])->first());
	}
}