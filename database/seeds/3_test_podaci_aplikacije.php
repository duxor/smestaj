<?php

use Illuminate\Database\Seeder;
use App\Tema;
use App\Sadrzaji;
use App\Templejt;
use App\Nalog;
class TestPodaciAlikacije extends Seeder{
    public function run(){
        $teme=[
            [
                'slug'=>'test-tema-1',
                'naziv'=>'Test tema 1',
                'opis'=>'Test tema opis...'
            ],
            [
                'slug'=>'test-tema-2',
                'naziv'=>'Test tema 2',
                'opis'=>'Test tema opis...'
            ],
            [
                'slug'=>'test-tema-3',
                'naziv'=>'Test tema 3',
                'opis'=>'Test tema opis...'
            ],
            [
                'slug'=>'test-tema-4',
                'naziv'=>'Test tema 4',
                'opis'=>'Test tema opis...'
            ],
            [
                'slug'=>'test-tema-5',
                'naziv'=>'Test tema 5',
                'opis'=>'Test tema opis...'
            ],
            [
                'slug'=>'test-tema-6',
                'naziv'=>'Test tema 6',
                'opis'=>'Test tema opis...'
            ],
        ];
        Tema::insert($teme);

        $teme=Tema::where('id','<>',1)->get(['id'])->toArray();
        foreach($teme as $tema){
            $nalog=new Nalog();
                $nalog->naziv='Nalog broj '.$tema['id'];
                $nalog->slug='nalog-broj-'.$tema['id'];
                $nalog->korisnici_id=2;
                $nalog->tema_id=$tema['id'];
            $nalog->save();

            $this->templejtSadrzaj($tema['id'],'Početna','pocetna','Opis...',$nalog->id);
            $this->templejtSadrzaj($tema['id'],'O nama','o-nama','Opis...',$nalog->id);
            $this->templejtSadrzaj($tema['id'],'Smeštajni kapacitet','smestajni-kapaciteti','Opis...',$nalog->id);
            $this->templejtSadrzaj($tema['id'],'Nešto prvo','nesto-prvo','Opis...',$nalog->id);
            $this->templejtSadrzaj($tema['id'],'Nešto drugo','nesto-drugo','Opis...',$nalog->id);
            $this->templejtSadrzaj($tema['id'],'Kontakt','kontakt','Opis...',$nalog->id);
        }
    }
    function templejtSadrzaj($tema,$naziv,$slug,$opis,$nalog){
        $templejt=new Templejt();
            $templejt->slug=$slug;
            $templejt->vrsta_sadrzaja_id=1;
            $templejt->tema_id=$tema;
        $templejt->save();

        $sadrzaj=new Sadrzaji();
            $sadrzaj->naziv=$naziv;
            $sadrzaj->sadrzaj=$opis;
            $sadrzaj->templejt_id=$templejt->id;
            $sadrzaj->nalog_id=$nalog;
        $sadrzaj->save();
    }
}