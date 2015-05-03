<?php namespace App;
use Illuminate\Support\Facades\Session;
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
}