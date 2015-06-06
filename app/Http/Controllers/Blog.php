<?php namespace App\Http\Controllers;
use App\BlogTabela;
use App\Http\Requests;
use App\Nalog;
use App\Security;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class Blog extends Controller {
    private function blog($slug,$akcija){
        $podaci['prava']=$slug;
        $podaci['akcija']=$akcija;
        if(Security::autentifikacijaTest(4,'min')) $podaci['app']=Nalog::where('korisnici_id',Session::get('id'))->lists('naziv','id');
        return view('blog.index',compact('podaci'));
    }
    public function getIndex($slugPrava){
        return $this->blog($slugPrava,'pregled');
    }
    public function postPregled($slug,$username){
        if($username!=Session::get('username')||!Security::autentifikacijaTest(4,'min')) return json_encode(null);
        return json_encode(BlogTabela::where('korisnici_id',Session::get('id'))->select('naslov',DB::raw('left(tekst,150) as tekst'),'aktivan')->get()->toArray());
    }
    public function postDodajObjavu(){
        if(!Security::autentifikacijaTest(4,'min')) return json_encode(['msg'=>'Greška u autentifikaciji. Proverite podatke i pokušajte ponovo.','check'=>0]);
        $podaci=json_decode(Input::get('podaci'));
        BlogTabela::insert([
            ['naslov'=>$podaci->naslov,'tekst'=>$podaci->tekst,'korisnici_id'=>Session::get('id'),'nalog_id'=>$podaci->app]
        ]);
        return json_encode(['msg'=>'Uspešno ste izvršili dodavanje objave.','check'=>1]);
    }
}
