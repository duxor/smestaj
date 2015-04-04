<?php
use Illuminate\Database\Seeder;
use App\Security;
use App\PravaPristupa;
use App\Korisnici;
use App\VrstaSadrzaja;
use App\Tema;
use App\Templejt;
use App\Sadrzaji;
use App\Nalog;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
        PravaPristupa::insert([
            [
                'naziv' => 'Zabranjen'//1
            ],
            [
                'naziv' => 'Korisnik'//2
            ],
            [
                'naziv' => 'Analitičar'//3
            ],
            [
                'naziv' => 'Moderator'//4 -- vlasnikss
            ],
            [
                'naziv' => 'Administrator'//5
            ],
            [
                'naziv' => 'Kreator'//6
            ]
        ]);
        Korisnici::insert([
            [
                'prezime' => 'Zabranjen',
                'ime' => 'Zabranjen',
                'email' => 'zabrana@zabrana.com',
                'username' => 'zabrana',
                'password' => Security::generateHashPass('zabrana'),
                'pravapristupa_id' => 1,
                'aktivan' => 0
            ],
            [
                'prezime' => 'Administrator',
                'ime' => 'Administrator',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => Security::generateHashPass('admin'),
                'pravapristupa_id' => 6,
                'aktivan' => 1
            ]
        ]);
        VrstaSadrzaja::insert([
            [
                'naziv'=>'text-meni'//1
            ],
            [
                'naziv'=>'text'//2
            ],
            [
                'naziv'=>'email'//3
            ],
            [
                'naziv'=>'koordinata'//4
            ],
        ]);
        Tema::insert([
            [//1
                'slug'=>'osnovna',
                'naziv'=>'Osnovna',
                'opis'=>'Osnovna tema.'
            ]
        ]);
        Templejt::insert([
            [//1
                'slug'=>'pocetna',
                'vrsta_sadrzaja_id'=>1,
                'tema_id'=>1,
            ],
            [//2
                'slug'=>'smestaj',
                'vrsta_sadrzaja_id'=>1,
                'tema_id'=>1,
            ],
            [//3
                'slug'=>'rezervacije',
                'vrsta_sadrzaja_id'=>1,
                'tema_id'=>1,
            ],
            [//4
                'slug'=>'kontakt',
                'vrsta_sadrzaja_id'=>1,
                'tema_id'=>1,
            ],
            [//5
                'slug'=>'login',
                'vrsta_sadrzaja_id'=>1,
                'tema_id'=>1,
            ]
        ]);
        Nalog::insert([
            [
                'naziv'=>'Osnovni',
                'slug'=>'osnovna',
                'korisnici_id'=>2,
                'tema_id'=>1
            ]
        ]);
        Sadrzaji::insert([
            [
                'naziv'=>'Početna',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'templejt_id'=>1,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Smeštaj',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'templejt_id'=>1,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Rezervacije',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'templejt_id'=>1,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Kontakt',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'templejt_id'=>1,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Login',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'templejt_id'=>1,
                'nalog_id'=>1
            ],
        ]);
    }
}