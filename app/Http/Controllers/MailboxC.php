<?php namespace App\Http\Controllers;

use App\Http\Requests;

class MailboxC extends Controller {
	public function mailbox($slug,$akcija){
		$podaci['prava']=$slug;
		$podaci['akcija']=$akcija;
		return view('mailbox.index',compact('podaci'));
	}
	public function getIndex($pravaSlug){
		return redirect($pravaSlug.'/mailbox/inbox');
	}
	public function getKreiraj($pravaSlug){
		return $this->mailbox($pravaSlug,'nova');
	}
	public function getInbox($pravaSlug){
		return $this->mailbox($pravaSlug,'inbox');
	}
	public function getPoslate($pravaSlug){
		return $this->mailbox($pravaSlug,'poslate');
	}
}
