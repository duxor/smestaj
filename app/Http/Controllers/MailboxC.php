<?php namespace App\Http\Controllers;

use App\Http\Requests;
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
	public function getIndex($pravaSlug){
		return redirect($pravaSlug.'/mailbox/inbox');
	}
	public function getKreiraj($pravaSlug){
		return $this->mailbox($pravaSlug,'nova');
	}
//INBOX
	public function getInbox($pravaSlug){
		return $this->mailbox($pravaSlug,'inbox');
	}
	public function postUcitajInbox(){
		return json_encode(Mailbox::where('korisnici_id',Session::get('id'))->orderby('created_at','DESC')->get(['id','od_email','naslov','procitano','created_at'])->toArray());
	}
	public function postUcitajPoruku(){
		if(!Security::autentifikacijaTest())return Security::rediectToLogin();
		Mailbox::where('id',Input::get('id'))->update(['procitano'=>1]);
		return json_encode(Mailbox::where('korisnici_id',Session::get('id'))->where('id',Input::get('id'))->where('korisnici_id',Session::get('id'))->get(['od_email','naslov','poruka','procitano','created_at'])->first());
	}
	public function postPosaljiPoruku(){
		return json_encode(['msg'=>'Poruka je uspešno poslata.','check'=>1]);
	}

	public function getPoslate($pravaSlug){
		return $this->mailbox($pravaSlug,'poslate');
	}
}
