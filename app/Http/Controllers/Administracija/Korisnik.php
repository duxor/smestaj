<?php namespace App\Http\Controllers\Administracija;
use App\BlogTabela;
use App\Dodatno;
use App\Http\Controllers\Controller;

use App\Komentari;
use App\Korisnici;
use App\ListaZelja;
use App\Log;
use App\Mailbox;
use App\Nalog;
use App\Newsletter;
use App\Objekat;
use App\OsnovneMetode;
use App\PassReset;
use App\PravaPristupa;
use App\Rezervacije;
use App\Sadrzaji;
use App\Security;
use App\Smestaj;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
/* duXor 09.04.2015. */
class Korisnik extends Controller {
    public function getIndex(){
        $korisnici = Korisnici::join('pravapristupa', 'korisnici.pravapristupa_id','=','pravapristupa.id')->orderBy('pravapristupa_id','DESC')->get(['prezime','ime','username','naziv as pravaPristupa','aktivan'])->toArray();
        return Security::autentifikacija('administracija.korisnik.index',compact('korisnici'),5,'min');
    }
    public function getNovi(){
        $prava = PravaPristupa::where('id','<','5')->orderBy('id','DESC')->lists('naziv','id');
        return Security::autentifikacija('administracija.korisnik.edit', ['prava'=>$prava],5,'min');
    }
    public function postNovi(){
        if(Security::autentifikacijaTest(5,'min')){
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
            if(!Input::get('id')) OsnovneMetode::kreiranjeKorisnika($novi->username);
            return redirect('/administracija/korisnik');
        }else return Security::rediectToLogin();
    }
    public function getUkloni($username){
        if(Security::autentifikacijaTest(5,'min')){
            //potrebno je ukloniti sve zapise sa kojima je vezan dati korisnik
            $id=Korisnici::where('username',$username)->get(['id'])->first()->id;
            Log::where('korisnici_id',$id)->delete();
            PassReset::where('korisnici_id',$id)->delete();
            Mailbox::where('korisnici_id',$id)->delete();
            BlogTabela::where('korisnici_id',$id)->delete();
            Komentari::where('korisnici_id',$id)->delete();
            ListaZelja::where('korisnici_id',$id)->delete();
            Rezervacije::where('korisnici_id',$id)->delete();
            Dodatno::join('smestaj','smestaj.id','=','dodatno.smestaj_id')->join('objekat as o','o.id','=','smestaj.objekat_id')->join('nalog as n','n.id','=','o.nalog_id')->where('n.korisnici_id',$id)->delete();
            Smestaj::join('objekat as o','o.id','=','smestaj.objekat_id')->join('nalog as n','n.id','=','o.nalog_id')->where('korisnici_id',$id)->delete();
            Objekat::join('nalog as n','n.id','=','objekat.nalog_id')->where('korisnici_id',$id)->delete();
            Newsletter::join('nalog as n','n.id','=','newsletter.nalog_id')->where('n.korisnici_id',$id)->delete();
            Sadrzaji::join('nalog as n','n.id','=','sadrzaji.nalog_id')->where('n.korisnici_id',$id)->delete();
            Nalog::where('korisnici_id',$id)->delete();
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
        return Security::autentifikacija('administracija.korisnik.edit', compact('korisnik', 'prava'),5,'min');
    }
    public function getStatus($username){
        if(Security::autentifikacijaTest(5,'min')){
            $korisnik = Korisnici::where('username','=',$username)->get(['id','aktivan'])->first();
            $korisnik->aktivan = $korisnik->aktivan ? 0 : 1;
            $korisnik->save();
            return Redirect::back();
        }
        return Security::rediectToLogin();
    }
}
