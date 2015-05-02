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
use App\Kapacitet;
use App\VrstaObjekta;
use App\VrstaSmestaja;
use App\DefaultSadrzaji;
class KonfiguracioniPodaci extends Seeder{
    public function run(){
        PravaPristupa::insert([
            ['naziv' => 'Zabranjen'],//1
            ['naziv' => 'Gost'],//2
            ['naziv' => 'Analitičar'],//3
            ['naziv' => 'Moderator'],//4 -- vlasnikss
            ['naziv' => 'Administrator'],//5
            ['naziv' => 'Kreator']//6
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
            ['naziv'=>'text-meni'],//1
            ['naziv'=>'text'],//2
            ['naziv'=>'link-meni'],//3
            ['naziv'=>'email'],//4
            ['naziv'=>'koordinata'],//5
            ['naziv'=>'slika'],//6
            ['naziv'=>'galerija'],//7
            ['naziv'=>'za-prosirenje']//8
        ]);
        Tema::insert([
            [//1
                'slug'=>'osnovna',
                'naziv'=>'Osnovna',
                'opis'=>'Osnovna tema.',
                'aktivan'=>0
            ],
            [//2
                'slug'=>'paralax-1',
                'naziv'=>'Paralax 1',
                'opis'=>'Osnovna tema moderatorske platforme.',
                'aktivan'=>1
            ]
        ]);
        Templejt::insert([
            ['slug'=>'pocetna',     'vrsta_sadrzaja_id'=>3, 'tema_id'=>1],//1
            ['slug'=>'smestaj',     'vrsta_sadrzaja_id'=>1, 'tema_id'=>1],//2
            ['slug'=>'rezervacije', 'vrsta_sadrzaja_id'=>1, 'tema_id'=>1],//3
            ['slug'=>'kontakt',     'vrsta_sadrzaja_id'=>1, 'tema_id'=>1],//4
            ['slug'=>'pozadina-1',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1],//5
            ['slug'=>'pozadina-2',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1],//6
            ['slug'=>'pozadina-3',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1],//7
            ['slug'=>'pozadina-4',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1],//8
            ['slug'=>'osnovna',     'vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//9
            ['slug'=>'slajder-1',   'vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//10
            ['slug'=>'pozadine-1',  'vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//11
            ['slug'=>'prosirenje-1','vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//12
            ['slug'=>'prosirenje-2','vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//13
            ['slug'=>'prosirenje-3','vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//14
            ['slug'=>'prosirenje-4','vrsta_sadrzaja_id'=>7, 'tema_id'=>1],//15

            ['slug'=>'pocetna',     'vrsta_sadrzaja_id'=>3, 'tema_id'=>2],//16
            ['slug'=>'o-nama',      'vrsta_sadrzaja_id'=>1, 'tema_id'=>2],//17
            ['slug'=>'smestaj',     'vrsta_sadrzaja_id'=>1, 'tema_id'=>2],//18
            ['slug'=>'rezervacije', 'vrsta_sadrzaja_id'=>1, 'tema_id'=>2],//19
            ['slug'=>'kontakt',     'vrsta_sadrzaja_id'=>3, 'tema_id'=>2],//20
            ['slug'=>'pozadina-1',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2],//21
            ['slug'=>'pozadina-2',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2],//22
            ['slug'=>'pozadina-3',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2],//23
            ['slug'=>'pozadina-4',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2],//24
            ['slug'=>'osnovna',     'vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//25
            ['slug'=>'slajder-1',   'vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//26
            ['slug'=>'pozadine-1',  'vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//27
            ['slug'=>'prosirenje-1','vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//28
            ['slug'=>'prosirenje-2','vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//29
            ['slug'=>'prosirenje-3','vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//30
            ['slug'=>'prosirenje-4','vrsta_sadrzaja_id'=>7, 'tema_id'=>2],//31
        ]);
        Nalog::insert([
            [//1
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
                'icon'=>'glyphicon glyphicon-search',
                'templejt_id'=>1,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Smeštaj',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'icon'=>'glyphicon glyphicon-home',
                'templejt_id'=>2,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Popusti',
                'sadrzaj'=>'<p>Tekst je u pripremi (Rezervišite online i ostvarite bonus i popuste za naredni period).</p>',
                'icon'=>'glyphicon glyphicon-calendar',
                'templejt_id'=>3,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Kontakt',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'icon'=>'glyphicon glyphicon-earphone',
                'templejt_id'=>4,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Pozadina 1',
                'sadrzaj'=>'teme/osnovna-paralax/slike/15.jpg',
                'icon'=>null,
                'templejt_id'=>5,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Pozadina 2',
                'sadrzaj'=>'teme/osnovna-paralax/slike/19.jpg',
                'icon'=>null,
                'templejt_id'=>6,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Pozadina 3',
                'sadrzaj'=>'teme/osnovna-paralax/slike/28.jpg',
                'icon'=>null,
                'templejt_id'=>7,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Pozadina 4',
                'sadrzaj'=>'teme/osnovna-paralax/slike/34.jpg',
                'icon'=>null,
                'templejt_id'=>8,
                'nalog_id'=>1
            ]
        ]);
        DefaultSadrzaji::insert([
            [
                'naziv'=>'Početna',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'icon'=>'glyphicon glyphicon-search',
                'templejt_id'=>16
            ],
            [
                'naziv'=>'O nama',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'icon'=>'glyphicon glyphicon-user',
                'templejt_id'=>17
            ],
            [
                'naziv'=>'Smeštaj',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'icon'=>'glyphicon glyphicon-home',
                'templejt_id'=>18
            ],
            [
                'naziv'=>'Popusti',
                'sadrzaj'=>'<p>Tekst je u pripremi (Rezervišite online i ostvarite bonus i popuste za naredni period).</p>',
                'icon'=>'glyphicon glyphicon-calendar',
                'templejt_id'=>19
            ],
            [
                'naziv'=>'Kontakt',
                'sadrzaj'=>'<p>Tekst je u pripremi.</p>',
                'icon'=>'glyphicon glyphicon-earphone',
                'templejt_id'=>20
            ],
            [
                'naziv'=>'Pozadina 1',
                'sadrzaj'=>'teme/osnovna-paralax/slike/15.jpg',
                'icon'=>null,
                'templejt_id'=>21
            ],
            [
                'naziv'=>'Pozadina 2',
                'sadrzaj'=>'teme/osnovna-paralax/slike/19.jpg',
                'icon'=>null,
                'templejt_id'=>22
            ],
            [
                'naziv'=>'Pozadina 3',
                'sadrzaj'=>'teme/osnovna-paralax/slike/28.jpg',
                'icon'=>null,
                'templejt_id'=>23
            ],
            [
                'naziv'=>'Pozadina 4',
                'sadrzaj'=>'teme/osnovna-paralax/slike/34.jpg',
                'icon'=>null,
                'templejt_id'=>24
            ],
            [
                'naziv'=>'Galerija osnovnih fotografija',
                'sadrzaj'=>'',
                'icon'=>null,
                'templejt_id'=>25
            ],
            [
                'naziv'=>'Pozadine',
                'sadrzaj'=>'',
                'icon'=>null,
                'templejt_id'=>26
            ],
            [
                'naziv'=>'Slajderi',
                'sadrzaj'=>'',
                'icon'=>null,
                'templejt_id'=>27
            ]
        ]);
        VrstaObjekta::insert([
            ['naziv'=>'Hotel'],
            ['naziv'=>'Hostel'],
            ['naziv'=>'Motel'],
            ['naziv'=>'Privatni smeštaj']
        ]);
        VrstaSmestaja::insert([
            ['naziv'=>'Soba'],
            ['naziv'=>'Apartman']
        ]);
        Kapacitet::insert([
            ['naziv'=>'','broj_osoba'=>1],
            ['naziv'=>'','broj_osoba'=>2],
            ['naziv'=>'Bračni krevet','broj_osoba'=>2],
            ['naziv'=>'','broj_osoba'=>3],
            ['naziv'=>'','broj_osoba'=>4],
            ['naziv'=>'','broj_osoba'=>5],
            ['naziv'=>'','broj_osoba'=>6],
            ['naziv'=>'','broj_osoba'=>7],
            ['naziv'=>'','broj_osoba'=>8],
            ['naziv'=>'','broj_osoba'=>9],
            ['naziv'=>'','broj_osoba'=>10],
            ['naziv'=>'','broj_osoba'=>11],
            ['naziv'=>'','broj_osoba'=>12],
            ['naziv'=>'','broj_osoba'=>13]
        ]);
    }
}