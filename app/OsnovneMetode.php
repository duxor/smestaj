<?php namespace App;

class OsnovneMetode {
    public static function listaFotografija($folder){
        return glob($folder.'/*.{jpg,jpeg,png,gif}',GLOB_BRACE);;
    }
}