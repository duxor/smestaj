<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Templejt;
use App\Korisnici;
use App\Security;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class Profil extends Controller {


	public function getIndex(){
		
    }


    public function getLogin(){
<<<<<<< HEAD
    	 if(Security::autentifikacijaTest()) return view('/profil/profil');
=======
    	if(Security::autentifikacijaTest()) return redirect('/profil');
>>>>>>> origin/master
        return view('korisnik.prijava.index');
	}

    public function postLogin(){
		return Security::login(Input::get('username'),Input::get('password'));

	}

	public function getProfil(){

		
		$value = Session::get('id');
		$korisnik=Korisnici::where('id','=','value')->get();
		return view('korisnik.profil.index',compact('korisnik'));
		
		
	}
	public function getEditNalog(){

		$korisnik=Korisnici::find('4');//ovo resiti
		return view('korisnici.profil.edit',compact('korisnik'));
		
		
	}
	public function postFormEdit(){

		$korisnik= Korisnici::firstOrNew(['id'=>Input::get('id')],['id','prezime','ime' ,'username','email']);  
		$korisnik->prezime=Input::get('prezime');
		$korisnik->ime=Input::get('ime');
		$korisnik->username=Input::get('username');
		$korisnik->email=Input::get('email');;
		$korisnik->save();
		$korisnik=Korisnici::find('4');
		return view('korisnici.profil.index',compact('korisnik'));
		
	}



}
