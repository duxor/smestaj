<?php namespace App\Http\Controllers\Mailer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Security;

class Mailer extends Controller {
	//TEST APP
	public function getIndex()
	{
		if(!Security::autentifikacijaTest(5,'min')) return Security::rediectToLogin();

		$toMail='kontakt@dusanperisic.com';
		$toName='duXor zvani Faca!';
		$subject='Prva porukaaaaa!! duXor faca neviđena, planira da kupi Aston Martinaaaa!';

		$template='template-najsmestaj';
		Mail::send('mailer.'.$template, [
			'heder'=>'http://test.najsmestaj.com/teme/osnovna-paralax/slike/logo/mail-header.jpg',
			'naslovna'=>'http://test.najsmestaj.com/galerije/__dodaci/aston-martin-2.jpg',
			'footer'=>'http://test.najsmestaj.com/teme/osnovna-paralax/slike/logo/mail-footer.jpg'
		], function($message) use ($toMail,$toName,$subject) {
			$message->to($toMail, $toName)
				->subject($subject);
		});
		return 'Poruka je uspješno poslata!';
	}
	public function getRemote()
	{
		if(!Security::autentifikacijaTest(5,'min')) return Security::rediectToLogin();

		Mail::send('mailer.template-najsmestaj-remote', [
			'heder'=>'http://test.najsmestaj.com/teme/osnovna-paralax/slike/logo/mail-header.jpg',
			'naslovna'=>'http://test.najsmestaj.com/galerije/__dodaci/aston-martin-2.jpg',
			'footer'=>'http://test.najsmestaj.com/teme/osnovna-paralax/slike/logo/mail-footer.jpg'
		], function($message) {
			$message->to('kontakt@dusanperisic.com', 'duXor zvani Faca!')
				->subject('Prva porukaaaaa!! duXor faca neviđena, planira da kupi Aston Martinaaaa!');
		});
		return 'Poruka je uspješno poslata!';
	}

}
