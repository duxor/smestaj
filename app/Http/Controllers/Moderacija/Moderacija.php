<?php namespace App\Http\Controllers\Moderacija;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Security;
use App\Tema;
use App\Nalog;
use App\Templejt;
use App\Sadrzaji;


class Moderacija extends Controller {
	public function getIndex(){

		$nalozi=Nalog::join ('korisnici', 'nalog.korisnici_id','=','korisnici.id' )
			->join('tema','nalog.tema_id','=','tema.id')
			->select('nalog.id','nalog.naziv as naziv','nalog.slug','nalog.aktivan','tema.naziv as tema','korisnici.ime')
			->get()->toArray();
		return Security::autentifikacija('moderacija.aplikacija.index', compact('nalozi'),4);
	}
	public function getPodesavanja()
	{	
		$idkor=Session::get('id');
		$nalozi=Nalog::where('korisnici_id',$idkor)->lists('naziv', 'id');
		$tema_id= Tema::lists('naziv','id');
		return Security::autentifikacija('moderacija.aplikacija.podesavanja',compact('tema_id','nalozi'),4);
	}
	public function postPodesavanja()
	{
		if(Security::autentifikacijaTest(4)){

			$nalog_naziv=Nalog::firstOrNew(['id'=>Input::get('nalog')],['naziv']);

			$nalog= Nalog::firstOrNew(['naziv'=>$nalog_naziv['naziv']],['saradnja','tema_id']);
			$nalog->tema_id=Input::get('tema');
			$nalog->saradnja=Input::get('saradnja');
			$nalog->save();

			$tema_id=Input::get('tema');
			$templejt=Templejt::where('tema_id',$tema_id)->get(['id','slug'])->toArray();

			foreach ($templejt as $templ) 
			{
				$sadrzaj=new Sadrzaji;
				$sadrzaj->naziv=$templ['slug'];
				$sadrzaj->sadrzaj='Tekst je u pripremi';
				$sadrzaj->templejt_id=$templ['id'];
				$sadrzaj->nalog_id=Input::get('nalog');
				$sadrzaj->save();
			}
			return redirect('/moderator/podesavanja');
		}
		return Security::rediectToLogin();	
	
	}


}
