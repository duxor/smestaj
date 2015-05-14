<?php namespace App\Http\Controllers;

use App\Http\Requests;

class MailboxC extends Controller {
	public function getIndex($pravaSlug){
		return redirect($pravaSlug.'/mailbox/inbox');
	}
	public function getKreiraj(){

	}
	public function getInbox(){

	}
	public function getPoslate(){

	}
}
