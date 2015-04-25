<?php

use Illuminate\Database\Seeder;
use App\Sadrzaji;
use App\Nalog;
use App\DefaultSadrzaji;
class TestPodaciAlikacije extends Seeder{
    public function run(){
        Nalog::insert([
            ['naziv'=>'Moderatorska App','slug'=>'moderator-app','korisnici_id'=>4],
            ['naziv'=>'Todorović App','slug'=>'todorovic-app','korisnici_id'=>8],
            ['naziv'=>'Nenadović App','slug'=>'nenadovic-app','korisnici_id'=>14]
        ]);
        $defaulti=DefaultSadrzaji::join('templejt','default_sadrzaji.templejt_id','=','templejt.id')->where('templejt.tema_id',2)->get(['naziv','sadrzaj','icon','templejt_id'])->toArray();
        foreach($defaulti as $default)
            Sadrzaji::insert(array_merge($default,['nalog_id'=>2]));
    }
}