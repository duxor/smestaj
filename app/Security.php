<?php
/**
 * Klasa za obezbjeđenje bezbijednosti sistema administracije
 * User: Dušan Perišić
 * Date: 2/9/2015
 * Time: 12:20 AM
 *
 * Početna podešavanja:
 * * $salt - proizvoljan niz znakova za povećanje bezbijednosti jačine password-a
 * * $daminLogURL - adresa do login stranice za pristup administrativnom panelu
 * * korisnici - tabela u kojoj se nalaze korisnici sa poljima [id, username, password, token]
 * * log - tabela [id,korisnici_id,created_at]
 */


namespace App;

use App\Korisnici;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Security {
    private $id;
    private $username;
    private $password;
    private $salt='ix501^@)5MwfP39ijJDr27g';
    private static $userID=2;
    private static $modID=4;
    private static $adminID=5;
    private static $kreatorID=6;
    public static $adminURL='/administracija';
    public static $userURL='/profil';
    public static $modURL='/moderator';
    public static $logURL='/log/login';
    private $token;
    private $redirectURL;
    private $minLenPass=4;//minimalna duzina sifre i korisnickog imena
    private $prava_pristupa;//prava_pristupa_id

//SETERI[$redirectURL, $username, $password, $token, $_SESSION[token,id,username]]
    public function setRedirectURL($url){
        $this->redirectURL = $url;
    }
    private function setUsername($username){
        $this->username = $username;
    }
    private function setPass($pass){
        $this->password = $pass;
    }
    public function setToken($token){
        $this->token = $token;
    }
    private function setSessions(){
        Session::put('token', $this->token);
        Session::put('id', $this->id);
        Session::put('username', $this->username);
        Session::put('prava_pristupa', $this->prava_pristupa);
    }
//GENERATORI[hashPass, token]
    public static function generateHashPass($pass){
        $sec = new Security();
        $sec->setPass(password_hash($pass.$sec->salt, PASSWORD_BCRYPT, ['cost' => 12]));
        return $sec->password;
    }
    private function generateToken(){
        $this->setToken(hash('haval256,5', $this->salt.uniqid().openssl_random_pseudo_bytes(50), false));
        return $this->token;
    }
    public static function registracija($username,$email,$password,$prezime=null,$ime=null){
        if(isset($username)&&isset($password)&&isset($password)){
            $korisnik=new Korisnici();
                $korisnik->username=$username;
                $korisnik->email=$email;
                $korisnik->password=Security::generateHashPass($password);
                $korisnik->prezime=$prezime;
                $korisnik->ime=$ime;
                $korisnik->pravapristupa_id=2;
            $korisnik->save();
            Security::rediectToLogin();
        }
        return'GRESKA UNOSA!';
    }
//FUNKCIONALNOSTI

//#TESTERI[autentifikacija, input, login]
    public static function autentifikacijaTest($prava=2){
        if (Session::has('id') and Session::has('token') and Session::has('prava_pristupa')) {
            return Korisnici::where('id',Session::get('id'))->where('token', Session::get('token'))->where('pravapristupa_id','>=',$prava)->exists();// $korisnik ? true : false;
        } else return false;
    }
    private function inputTest($in){
        return strlen($in)>$this->minLenPass;
    }
    public static function login($username, $password){
        $sec = new Security();

        if($sec->inputTest($username) and $sec->inputTest($password)){
            $sec->setUsername($username);
            $sec->setPass($password);

            $korisnik = Korisnici::all(['id','username','password','pravapristupa_id'])->where('username',$sec->username)->first();
            $test = $korisnik ? password_verify($sec->password.$sec->salt, $korisnik->password) : false;

            if ($test){
                $sec->id = $korisnik->id;
                $sec->username = $korisnik->username;
                $sec->prava_pristupa = $korisnik->pravapristupa_id;
                $sec->generateToken();
                Korisnici::where('id', $sec->id)->update(['token' => $sec->token]);
                $sec->setSessions();
                Log::insert(['korisnici_id'=>$korisnik->id]);
            }else Korisnici::where('id', $sec->id)->update(['token' => null]);
        }
        return Security::rediectToLogin();
    }
//#REDIRECTORI[autentifikacija, logout, redirect, redirectToLogin]
    public static function autentifikacija($target,$dodaci=null,$prava=2){
        return Security::autentifikacijaTest($prava) ? $dodaci ? view($target, $dodaci) : view($target) : Security::rediectToLogin();
    }
    public static function logout(){
        if(Session::has('id')){
            $korisnik = Korisnici::all(['id','token'])->find(Session::get('id'));
            $korisnik->token = null;
            $korisnik->save();
        }
        Session::flush();
        return redirect('/');
    }
    public function redirect(){
        return redirect($this->redirectURL);
    }
    public static function rediectToLogin(){
        if(Session::has('prava_pristupa')){
            switch(Session::get('prava_pristupa')){
                case Security::$userID:return redirect(Security::$userURL);
                case Security::$modID:return redirect(Security::$modURL);
                case Security::$adminID:
                case Security::$kreatorID:
                    return redirect(Security::$adminURL);
            }
        }
        return redirect(Security::$logURL);
    }
}