<?php namespace App\Http\Controllers;
use App\BlogTabela;
use App\Http\Controllers\Controller;
//use App\Http\Requests;
//use Illuminate\Http\Request;
use Request; 
//use App\Http\Requests;
////use App\Http\Requests\Request;
use Illuminate\Contracts\Support\JsonableInterface;
use App\Nalog;
use App\Korisnici;
use App\Security;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Log;
use App\Templejt;
class Bloger extends Controller {

    public function getIndex(){
        $blog_podaci=BlogTabela::join('nalog as n','n.id','=','blog.nalog_id')
            ->join('korisnici as k','k.id','=','blog.korisnici_id')
            ->orderBy('blog.created_at','desc')
            ->where('blog.aktivan',1)->select('n.naziv','k.username','blog.id','blog.naslov','blog.tekst','blog.created_at','blog.slika')
            ->paginate(3);  
        
        $posts=BlogTabela::join('nalog as n','n.id','=','blog.nalog_id')
            ->join('korisnici as k','k.id','=','blog.korisnici_id')
            ->where('blog.aktivan',1)
            ->where('blog.id','<',10)
            ->orderBy('blog.created_at','desc')
            ->get(['n.naziv','k.username','blog.id','blog.naslov','blog.tekst','blog.created_at','blog.slika'])->take(10)->toArray();
        $podaci=Templejt::join('sadrzaji','sadrzaji.templejt_id','=','templejt.id')->where('nalog_id','=',1)->where('tema_id','=',1)->where('vrsta_sadrzaja_id','<>',6)->orderBy('redoslijed')->get(['slug','naziv','sadrzaj','vrsta_sadrzaja_id','icon'])->toArray();

        return view('korisnik.blog',compact('blog_podaci','podaci','posts'));
    }
    public function getBlogPost($id){
    	//dd($id);
       $podaci=BlogTabela::join('nalog as n','n.id','=','blog.nalog_id')
            ->join('korisnici as k','k.id','=','blog.korisnici_id')
            ->where('blog.id',$id)
            ->get(['n.naziv','k.username','blog.id','blog.naslov','blog.tekst','blog.created_at','blog.slika'])->first()->toArray();
        return view('korisnik.blog_post',compact('podaci'));
    }
    public function postPretraga(){
    		$pretraga=Input::get('pretraga');
    		$niz_kljucne_reci = explode(' ', $pretraga);	
    		$query = BlogTabela::join('nalog as n','n.id','=','blog.nalog_id')
            ->join('korisnici as k','k.id','=','blog.korisnici_id')
            ->where('blog.aktivan',1);
		    foreach($niz_kljucne_reci as $uslov)
		    {
		        $query->where('blog.tekst', 'LIKE', '%'. $uslov .'%')->orWhere('blog.naslov', 'LIKE', '%'. $uslov .'%');
		    }
		    $rezultat = $query->get(['blog.id','blog.naslov'])->toArray();
		    return json_encode($rezultat);	
	}

}
