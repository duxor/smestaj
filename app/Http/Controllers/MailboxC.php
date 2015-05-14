<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mailbox;
use App\Security;
use Illuminate\Support\Facades\Session;
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
		return json_encode(Mailbox::where('korisnici_id',Session::get('id'))->orderby('created_at','DESC')->get(['od_email','naslov','poruka','procitano','created_at'])->toArray());
	}

	public function getPoslate($pravaSlug){
		return $this->mailbox($pravaSlug,'poslate');
	}
}
