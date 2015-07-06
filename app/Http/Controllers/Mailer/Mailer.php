<?php namespace App\Http\Controllers\Mailer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Mailer extends Controller {

	public function getIndex()
	{
		Mail::send('mailer.template-najsmestaj', [], function($message) {
            $message->to('kontakt@dusanperisic.com', 'duXor zvani Faca!')
				->subject('Prva porukaaaaa!! duXor faca neviđena, planira da kupi Aston Martinaaaa!');
        });
		return 'Poruka je uspješno poslata!';
	}

}
