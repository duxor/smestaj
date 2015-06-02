<?php namespace App;
use Illuminate\Support\Facades\Session;
use DirectoryIterator;
class OsnovneMetode {
    public static function listaFotografija($folder){
        return glob($folder.'/*.{jpg,jpeg,png,gif}',GLOB_BRACE);
    }
    public static function randomFoto($folder){
        $lista=OsnovneMetode::listaFotografija($folder);
        return sizeof($lista)>0?$lista[rand(0,sizeof($lista)-1)]:null;
    }
    public static function randomFotoZaNalog($slug){
        $lista=Nalog::join('korisnici as k','k.id','=','nalog.korisnici_id')
                ->join('objekat as o','o.nalog_id','=','nalog.id')
                ->join('smestaj as s','s.objekat_id','=','o.id')
                ->where('nalog.aktivan',1)->where('o.aktivan',1)->where('s.aktivan',1)->where('nalog.slug','=',$slug)
                ->get(['username','s.slug'])->toArray();
        $foto=null;
        $rand=rand(0,sizeof($lista)-1);
        $current=$rand;
        $active=$rand != sizeof($lista) - 1 ? $rand+1 : 0;
        if($lista)
            while($foto==null&&$active!=$current){
                $foto=!$active?OsnovneMetode::randomFoto("galerije/{$lista[$rand]['username']}/aplikacije/{$slug}/smestaji/{$lista[$rand]['slug']}"):OsnovneMetode::randomFoto("galerije/{$lista[$active]['username']}/aplikacije/{$slug}/smestaji/{$lista[$active]['slug']}");
                if($foto==null)
                    $active = $active != sizeof($lista) - 1 ? $active+1 : 0;
            }
        return $foto;
    }
    public static function folderGalerije($vrsta_sadrzaja,$slugGalerije,$slugApp=null,$slugTema=null){
        switch($vrsta_sadrzaja){
            case 7: return"galerije/".Session::get('username')."/{$slugGalerije}";
            case 8: return"galerije/".Session::get('username')."/aplikacije/{$slugApp}/{$slugTema}/{$slugGalerije}";
            case 9: return"galerije/".Session::get('username')."/aplikacije/{$slugApp}/korisnicke-galerije/{$slugGalerije}";
        }
    }
    public static function aplikacije(){
        return Nalog::where('korisnici_id',Session::get('id'))->get(['slug','naziv'])->toArray();
    }
    public static function dugmiciZaIzborPozadine($pozadine,$setpozadina){
        $dugmici='';
        foreach($pozadine as $pozadina){
            $dugmici.="<button class='btn btn-info' data-dismiss='modal' onclick=\"pozadina({$pozadina['id']},'{$setpozadina}')\">{$pozadina['sadrzaj_naziv']}</button>";
        }
        return $dugmici;
    }
    public static function kreirjFolder($adresa){
        if (!is_dir($adresa)) return mkdir($adresa, 0755, true);
        return false;
    }
    public static function kreiranjeKorisnika($username){
        OsnovneMetode::kreirjFolder("galerije/{$username}/osnovne");
        copy("galerije/default-galerije/osnovne/profilna.jpg","galerije/{$username}/osnovne/profilna.jpg");
        OsnovneMetode::kreirjFolder("galerije/{$username}/ostale");
    }
    public static function primenaTeme($appID,$tema_id){
        $defaulti=DefaultSadrzaji::join('templejt','default_sadrzaji.templejt_id','=','templejt.id')->where('templejt.tema_id',$tema_id)->get(['naziv','sadrzaj','icon','templejt_id'])->toArray();
        foreach($defaulti as $default)
            Sadrzaji::insert(array_merge($default,['nalog_id'=>$appID]));
    }
    public static function kreiranjeAplikacije($slugApp,$username,$appID,$tema_id){
        OsnovneMetode::kreirjFolder("galerije/{$username}/aplikacije/{$slugApp}");
        OsnovneMetode::kreirjFolder("galerije/{$username}/aplikacije/{$slugApp}/korisnicke-galerije");
        OsnovneMetode::kreirjFolder("galerije/{$username}/aplikacije/{$slugApp}/smestaji");
        OsnovneMetode::primenaTeme($appID,$tema_id);
        $temaSlug=Tema::find($tema_id,['slug'])->slug;
        OsnovneMetode::kopirajFolder("galerije/default-galerije/teme/{$temaSlug}","galerije/{$username}/aplikacije/{$slugApp}/{$temaSlug}");
    }
    public static function kopirajFolder($src, $dest){
        if(!is_dir($src)) return false;
        if(!is_dir($dest)) if(!mkdir($dest)) return false;
        $i = new DirectoryIterator($src);
        foreach($i as $f) {
            if($f->isFile()) {
                copy($f->getRealPath(), "$dest/" . $f->getFilename());
            } else if(!$f->isDot() && $f->isDir()) {
                OsnovneMetode::kopirajFolder($f->getRealPath(), "$dest/$f");
            }
        }
    }
    function rmove($src, $dest){
        if(!is_dir($src)) return false;
        if(!is_dir($dest))
            if(!mkdir($dest)) return false;
        $i = new DirectoryIterator($src);
        foreach($i as $f) {
            if($f->isFile()) {
                rename($f->getRealPath(), "$dest/" . $f->getFilename());
            } else if(!$f->isDot() && $f->isDir()) {
                rmove($f->getRealPath(), "$dest/$f");
                unlink($f->getRealPath());
            }
        }
        unlink($src);
    }
    public static function ukloniFolder($dirname) {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    OsnovneMetode::ukloniFolder($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
    public static function brojNeprocitanihPoruka(){
        return Mailbox::where('korisnici_id',Session::get('id'))->where('procitano',0)->where('copy',0)->count();
    }
    public static function osnovniNav(){
        switch(Session::get('prava_pristupa')){
            case 2:return'korisnik';break;
            case 4:return'moderacija';break;
            case 5:
            case 6:return'administracija';break;
        }
    }
    public static function arrayGenertor($n,$i=1,$array=[]){
        $array[$i]=$i; $i++;
        if($i>$n) return $array;
        return OsnovneMetode::arrayGenertor($n,$i,$array);
    }
    public static function getBrojRezervacija(){
        return Rezervacije::join('smestaj','smestaj.id','=','rezervacije.smestaj_id')
            ->join('objekat','objekat.id','=','smestaj.objekat_id')
            ->join('nalog','nalog.id','=','objekat.nalog_id')
            ->where('nalog.korisnici_id',Session::get('id'))
            ->whereNull('rezervacije.odjava')
            ->count();
    }
    public static function dostupnostZaRezervaciju($lokali,$od,$do,$ID='id'){
        foreach($lokali as $k=>$rezultat) {
            $rezervacija = Rezervacije::where('aktivan', 1)->where('smestaj_id', $rezultat[$ID])->get(['od', 'do'])->first();
            if ($rezervacija)
                if (strtotime($rezervacija->od) >= strtotime($do) || strtotime($rezervacija->do) <= strtotime($od));
                else unset($lokali[$k]);
        }
        return $lokali;
    }
    public static function dodatnaOprema($rezultati){
        $filter=[];
        foreach($rezultati as $k=>$rezultat){
            $filter[$rezultat['id']]=Dodatno::where('smestaj_id',$rezultat['id'])->lists('dodatna_oprema_id');
        }
        return json_encode($filter);
    }
    public static function brojKomentara(){
        return Komentari::join('smestaj as s','s.id','=','komentari.smestaj_id')
            ->join('objekat as o','o.id','=','s.objekat_id')
            ->join('nalog as n','n.id','=','o.nalog_id')
            ->where('n.korisnici_id',Session::get('id'))->where('komentari.aktivan',0)->count();
    }
    public static function podaciZaKalendar($slugSmestaj){
        $rezervacije=Rezervacije::join('smestaj as s','s.id','=','rezervacije.smestaj_id')->where('rezervacije.aktivan',1)->where('s.slug',$slugSmestaj)->get(['od','do'])->toArray();
        $dogadjaji='{';
        foreach($rezervacije as $rezervacija)
            foreach(OsnovneMetode::nizDatum($rezervacija['od'],$rezervacija['do']) as $datum)
                $dogadjaji.="\"{$datum}\":{},";
        $dogadjaji.='}';
        return $dogadjaji;
    }
    static function nizDatum($strDateFrom,$strDateTo){
    //YYYY-MM-DD
        $aryRange=array();
        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),substr($strDateTo,8,2),substr($strDateTo,0,4));
        if ($iDateTo>=$iDateFrom){
            array_push($aryRange,date('Y-m-d',$iDateFrom));
            while ($iDateFrom<$iDateTo){
                $iDateFrom+=86400;
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }
    static function komentariStranicenje($idSmjestaja,$stranica=1,$poStranici=5){
        $komentari=Komentari::join('korisnici','korisnici.id','=','komentari.korisnici_id')
            ->where('smestaj_id',$idSmjestaja)
            ->whereNull('odgovor_za_id')
            ->orderBy('created_at','desc')
            ->skip(($stranica-1)*$poStranici)->take($poStranici)
            ->get(['komentari.id','komentar','ocena','komentari.created_at','korisnici.username'])
            ->toArray();
        $odgovori=[];
        foreach($komentari as $k=>$koment){
            $odgovori[$k]=Komentari::join('komentari as k','k.odgovor_za_id','=','komentari.id')
                ->join('korisnici as ko','ko.id','=','k.korisnici_id')
                ->where('komentari.id',$koment['id'])
                ->get(['k.komentar as odgovor','k.created_at','k.ocena','username'])->toArray();
        }
        return ['komentari'=>$komentari,'odgovori'=>$odgovori];
    }
    public static function brojNewsletterKorisnika(){
        return Newsletter::whereIn('nalog_id',Nalog::where('korisnici_id',Session::get('id'))->get(['id'])->toArray())->count();
    }
}