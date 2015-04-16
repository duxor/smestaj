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
		$nalozi=Nalog::where('korisnici_id',$idkor)->where('aktivan',1)->lists('naziv', 'id');
		$tema_id= Tema::where('id','>','1')->lists('naziv','id');
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
			
			//ako postoji zapis preskoci ako ne dodaj novi
			if(!Sadrzaji::where('nalog_id',Input::get('nalog'))->exists())
			{
				foreach ($templejt as $templ) 
				{
					$sadrzaj=new Sadrzaji;
					$sadrzaj->naziv=$templ['slug'];
					$sadrzaj->sadrzaj='Tekst je u pripremi';
					$sadrzaj->templejt_id=$templ['id'];
					$sadrzaj->nalog_id=Input::get('nalog');
					$sadrzaj->save();
				}
			}
		
		
			return redirect('/moderator/podesavanja');
		}
		return Security::rediectToLogin();	
	
	}
	public function postPrenos()
	{
		 $izvor=Input::get('izvorisnatema');
		$odrediste=Input::get('odredisnatema');
		if(Security::autentifikacijaTest(4))
		{
			$a=Templejt::where('templejt.tema_id','=',Input::get('izvorisnatema'))
			->get(['templejt.id','templejt.slug'])->toArray();

				$sadrzaj= array();
				$slug=array();
			foreach ($a as $templ) 
			{
					$id=$templ['id'];
					
					$slug[]=$templ['slug'];
					$sadrzaj[]=Sadrzaji::where('templejt_id','=',$id)->get(['sadrzaj'])->first()->toArray();
					
			}
		$niz_slug_sadrzaj_izvoriste=array_combine($slug, $sadrzaj);
		
		}
		if(Security::autentifikacijaTest(4))
		{
			$a=Templejt::where('templejt.tema_id','=',Input::get('odredisnatema'))
			->get(['templejt.id','templejt.slug'])->toArray();

				$sadrzaj_odrediste= array();
				$slug_odrediste=array();
			foreach ($a as $templ) 
			{
					$id=$templ['id'];
					
					$slug_odrediste[]=$templ['slug'];
					$sadrzaj_odrediste[]=Sadrzaji::where('templejt_id','=',$id)->get(['sadrzaj'])->first()->toArray();
					
			}

			$niz_slug_sadrzaj_odrediste=array_combine($slug_odrediste, $sadrzaj_odrediste);	
		}
		
		$d=array_merge($niz_slug_sadrzaj_odrediste,$niz_slug_sadrzaj_izvoriste);
		$id=Templejt::where('tema_id','=', Input::get('odredisnatema'))->get(['id'])->toArray();
	
	}



}
