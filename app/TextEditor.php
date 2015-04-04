<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 2/18/2015
 * Time: 8:10 AM
 */

namespace App;


class TextEditor {
    private $readZnak = '<!--read more-->';
    public static function readMore($text){
        $txt = new TextEditor();
        $position = strpos($text, $txt->readZnak);
        return $position != 0 ? strstr($text, $position) : $text;
    }
    private function ukloniHtml($text){
        return strip_tags($text);
    }
    public static function ukloniFormat($lista){//uklanjanje formatiranja iz liste
        $txt = new TextEditor();
        foreach($lista as $key => $value){
            $lista[$key] = $txt->ukloniHtml($value);
        }
        return $lista;
    }
    public static function izbaciFormatiranjeNaslova($lista){
        $editor  = new TextEditor();
        return $editor->ukloniFormat($lista,'naslov');
    }

    //ogranjcavanje tekstualnog dijela sadrzaja zapisom $readZnak
    public static function readMoraFnalnost($lista){
        $editor = new TextEditor();
        foreach($lista as $key=>$value){
            $lista[$key]['sadrzaj'] = $editor->readMore($lista[$key]['sadrzaj']);
        }
        return $lista;
    }
}