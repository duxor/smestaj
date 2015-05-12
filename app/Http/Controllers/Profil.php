<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Templejt;
use App\Korisnici;
use App\Security;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class Profil extends Controller {


	public function getIndex(){
		if(Security::autentifikacijaTest())
		{
			$ids=Session::get('id');
			$korisnik=Korisnici::where('id', '=', $ids)->get(['id','ime','prezime','email','username','adresa','grad','telefon','fotografija'])->first()->toArray();
			$counter = 0;
			$procenat_popunjenosti=$this->proverapopunjenostiprofila();
			return view('korisnik.profil.index', compact('korisnik','procenat_popunjenosti'));
		}return view('korisnik.prijava.index');
    }
    private function proverapopunjenostiprofila(){
			$korisnik=Korisnici::where('id',Session::get('id'))->get(['id','ime','prezime','email','username','adresa','grad','telefon','fotografija'])->first()->toArray();
			$counter = 0;
			foreach($korisnik as $value)
			{
			  if($value === null || $value==='')
			    $counter++;
			}
			$counter=9-$counter;
			$procenat_popunjenosti=round($counter/9*100,0);
			return $procenat_popunjenosti;
    }
/*    public function getLogin(){
    	if(Security::autentifikacijaTest()) return redirect('/profil/');
        return view('korisnik.prijava.index');
	}

    public function postLogin(){
    		$data=Input::all();
			$rules = array(
	        'username'	=> 'Required|Between:5,12',
	        'password'  =>'Required|AlphaNum|Between:4,8|'
			);

			$v=Validator::make($data,$rules);

			if($v->fails())
			{
				return Redirect::to('/profil/login')->withErrors($v->errors());
			}
		return Security::login(Input::get('username'),Input::get('password'));
	}
*/
	public function getEditNalog(){
		if(Security::autentifikacijaTest())
		{
			$procenat_popunjenosti=$this->proverapopunjenostiprofila();
			$ids=Session::get('id');
			$korisnik=Korisnici::where('id', '=', $ids)->get(['id','ime','prezime','email','username','adresa','grad','telefon','fotografija'])->first()->toArray();
			return view('korisnik.profil.edit',compact('korisnik','procenat_popunjenosti'));
		}return view('korisnik.prijava.index');
	}
	public function postEditNalog(){
		//pocetak validacije
		$data=Input::all();
		$rules = [
	        'username'	=> 'Required|Between:5,45',
	        'email'     => 'Required|Between:3,64|Email'
			];
		$v=Validator::make($data,$rules);
		if($v->fails())
		{
			return Redirect::to('/profil/edit-nalog')->withErrors($v->errors());
		}
		//kraj validacije

		$korisnik= Korisnici::firstOrNew(['id'=>Input::get('id')],['id','prezime','ime' ,'username','password','email','adresa','grad','telefon','fotografija']);  
		$korisnik->prezime=Input::get('prezime');
		$korisnik->ime=Input::get('ime');
		$korisnik->username=Input::get('username');
		if(Input::get('password'))if(strlen(Input::get('password'))>4) $korisnik->password=Security::generateHashPass(Input::get('password'));
		$korisnik->email=Input::get('email');
		if(Input::get('adresa'))$korisnik->adresa=Input::get('adresa');
		if(Input::get('grad'))$korisnik->grad=Input::get('grad');
		if(Input::get('telefon'))$korisnik->telefon=Input::get('telefon');
		$korisnik->save();
		$procenat_popunjenosti=$this->proverapopunjenostiprofila();
		return Redirect::to('/profil');
	}
	public function postRegistracija(){
			$un=Input::get('username2');
			$email=Input::get('email2');
			$password=Input::get('password2');
			$password_confirm=Input::get('password_confirmation');
			$data=['username'=>$un,'email'=>$email,'password'=>$password,'password_confirmation'=>$password_confirm];
			$rules = array(
	        'username'	=> 'Required|Between:5,12|Unique:korisnici',
	        'email'     => 'Required|Between:3,64|Email|Unique:korisnici',
	        'password'  =>'Required|AlphaNum|Between:4,8|Confirmed',
            'password_confirmation'=>'Required|AlphaNum|Between:4,8'
			);
			$v=Validator::make($data,$rules);
			if($v->fails())
			{
				return Redirect::to('/profil/login')->withErrors($v->errors());
			}
        	Security::registracija(Input::get('username2'),Input::get('email2'),Input::get('password2'),Input::get('prezime2'), Input::get('ime2'));
	}
	public function postUploadProfilna(){
		if(!Security::autentifikacijaTest(2)){
			echo json_encode(['error'=>'Niste prijavljeni na platformu.']);
			return;
		}
		if (!$_FILES['image']){
			echo json_encode(['error'=>'Nije pronađena fotografija.']);
			return;
		}
		if (!Input::get('username')) {
			echo json_encode(['error'=>'Username nije pronađen.']);
			return;
		}
		$folder = 'galerije/'.$_POST['username'].'/osnovne/profilna.jpg';//.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$success = null;
		if(file_exists($folder)) unlink($folder);
		if(move_uploaded_file($_FILES['image']['tmp_name'], $folder)) $success = true;
		else $success = false;
		if ($success === true) $output = '[]';
		elseif ($success === false) {
			$output = ['error'=>'Greška prilikom upload-a. Kontaktirajte tehničku podršku platforme.'];
			unlink($folder);
		} else $output = ['error'=>'Fajlovi nisu procesuirani.'];
		echo json_encode($output);
		return;
	}
}
