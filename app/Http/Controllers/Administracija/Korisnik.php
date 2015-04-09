<?php namespace App\Http\Controllers\Administracija;
use App\Http\Controllers\Controller;

use App\Korisnici;
use App\PravaPristupa;
use App\Security;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
/* duXor 09.04.2015. */
class Korisnik extends Controller {
    public function getIndex(){
        $korisnici = Korisnici::join('pravaPristupa', 'korisnici.pravaPristupa_id','=','pravaPristupa.id')->orderBy('pravaPristupa_id','DESC')->get(['prezime','ime','username','naziv as pravaPristupa','aktivan'])->toArray();
        return Security::autentifikacija('administracija.korisnik.index',compact('korisnici'),5);
    }
    public function getNovi(){
        $prava = PravaPristupa::where('id','<','5')->orderBy('id','DESC')->lists('naziv','id');
        return Security::autentifikacija('administracija.korisnik.edit', ['prava'=>$prava],5);
    }
    public function postNovi(){
        if(Security::autentifikacijaTest(5)){
            if(Korisnici::where('id','<>',Input::get('id'))->where(function($query){
                return $query->where('username', '=', Input::get('username'))->orWhere('email','=',Input::get('email'));
            })->first()) return '<a href="/administracija/korisnik">Parametri Username ili Email već postoje u bazi!</a>';

            $novi = Korisnici::firstOrNew(['id'=>Input::get('id')]);
            $novi->prezime = Input::get('prezime');
            $novi->ime = Input::get('ime');
            $novi->username = Input::get('username');

            if(Input::get('password')) $novi->password = Security::generateHashPass(Input::get('password'));
            $novi->email = Input::get('email');
            $novi->pravaPristupa_id = Input::get('pravaPristupa_id');
            $novi->save();
            return redirect('/administracija/korisnik');
        }else return Security::rediectToLogin();
    }
    public function getUkloni($username){
        if(Security::autentifikacijaTest(5)){
            //potrebno je ukloniti sve zapise sa kojima je vezan dati korisnik
            //...
            Korisnici::where('username','=',$username)->delete();
            return Redirect::back();
        }
        return Security::rediectToLogin();
    }
    public function getProfil($username){
        if($username=='admin') return Redirect::back();
        $prava = PravaPristupa::where('id','<',5)->orderBy('id','DESC')->lists('naziv','id');
        $korisnik = Korisnici::where('username',$username)->first();
        return Security::autentifikacija('administracija.korisnik.edit', compact('korisnik', 'prava'),5);
    }
    public function getStatus($username){
        if(Security::autentifikacijaTest(5)){
            $korisnik = Korisnici::where('username','=',$username)->get(['id','aktivan'])->first();
            $korisnik->aktivan = $korisnik->aktivan ? 0 : 1;
            $korisnik->save();
            return Redirect::back();
        }
        return Security::rediectToLogin();
    }
}
