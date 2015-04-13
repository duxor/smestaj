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
			$korisnik=Korisnici::where('id', '=', $ids)->get(['id','ime','prezime','email','username'])->first()->toArray();
			return view('korisnik.profil.index', compact('korisnik'));
		}return view('korisnik.prijava.index');
    }
    public function getLogin(){
    	if(Security::autentifikacijaTest()) return redirect('/profil/');
        return view('korisnik.prijava.index');
	}

    public function postLogin(){
    		$data=Input::all();
			$rules = array(
	        'username'	=> 'Required|Between:5,12',
	        'password'  =>'Required|AlphaNum|Between:4,8|',
			);

			$v=Validator::make($data,$rules);

			if($v->fails())
			{
				return Redirect::to('/profil/login')->withErrors($v->errors());
			}
		return Security::login(Input::get('username'),Input::get('password'));
	}

	public function getEditNalog(){
		if(Security::autentifikacijaTest())
		{
			$ids=Session::get('id');
			$korisnik=Korisnici::where('id', '=', $ids)->get(['id','ime','prezime','email','username'])->first()->toArray();
			return view('korisnik.profil.edit',compact('korisnik'));
		}return view('korisnik.prijava.index');
	}
	public function postEditNalog(){
		//pocetak validacije
		$data=Input::all();
		$rules = array(
	        'username'	=> 'Required|Between:5,12',
	        'email'     => 'Required|Between:3,64|Email',
	        'password'  =>'AlphaNum|Between:4,8|',
			);
		$v=Validator::make($data,$rules);
		if($v->fails())
		{
			return Redirect::to('/profil/edit-nalog')->withErrors($v->errors());
		}
		//kraj validacije
		$pass=Input::get('password');
		$has_pass=Security::generateHashPass($pass);

		$korisnik= Korisnici::firstOrNew(['id'=>Input::get('id')],['id','prezime','ime' ,'username','password','email']);  
		$korisnik->prezime=Input::get('prezime');
		$korisnik->ime=Input::get('ime');
		$korisnik->username=Input::get('username');
		$korisnik->password=$has_pass;
		$korisnik->email=Input::get('email');;
		$korisnik->save();
		$ids=Session::get('id');
		
		$korisnik=Korisnici::where('id', '=', $ids)->get(['id','ime','prezime','email','username'])->first()->toArray();
		return view('korisnik.profil.index',compact('korisnik'));
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
}
