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

		$ids=Session::get('id');
		$korisnik=Korisnici::where('id','=','ids')->get(['prezime','ime','username','email'])->first()->toArray();
		return view('korisnik.profil.index', compact('korisnik'));
		
		
	}
	public function getEditNalog(){

		$korisnik=Korisnici::find('4');//ovo resiti
		return view('korisnik.profil.edit',compact('korisnik'));
		
		
	}
	public function postEditNalog(){

		$korisnik= Korisnici::firstOrNew(['id'=>Input::get('id')],['id','prezime','ime' ,'username','email']);  
		$korisnik->prezime=Input::get('prezime');
		$korisnik->ime=Input::get('ime');
		$korisnik->username=Input::get('username');
		$korisnik->email=Input::get('email');;
		$korisnik->save();
		$korisnik=Korisnici::find('4');
		return view('korisnik.profil.index',compact('korisnik'));
		
	}



}
