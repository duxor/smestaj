<?php namespace App;
use Illuminate\Support\Facades\Session;
use DirectoryIterator;
class OsnovneMetode {
    public static function listaFotografija($folder){
        return glob($folder.'/*.{jpg,jpeg,png,gif}',GLOB_BRACE);
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
        return Mailbox::where('korisnici_id',Session::get('id'))->where('procitano',0)->count();
    }
    public static function osnovniNav(){
        switch(Session::get('prava_pristupa')){
            case 5:return'administracija';
            case 4:return'moderacija';
            case 2:return'korisnik';
        }
        return'korisnik';
    }
}