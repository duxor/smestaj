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
use App\DodatnaOprema;
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
            ['naziv'=>'galerija-osnovna'],//7----->/galerija/{username}
            ['naziv'=>'galerija-aplikativna'],//8->/galerija/{username}/aplikacije/{slugApp}/{slugTema}
            ['naziv'=>'galerija-korisnicka'],//9-->/galerija/{username}/korisnicke-galerije
            ['naziv'=>'za-prosirenje']//10
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
            ['slug'=>'pocetna',     'vrsta_sadrzaja_id'=>3, 'tema_id'=>1,   'redoslijed'=>1],//1
            ['slug'=>'smestaj',     'vrsta_sadrzaja_id'=>1, 'tema_id'=>1,   'redoslijed'=>3],//2
            ['slug'=>'rezervacije', 'vrsta_sadrzaja_id'=>1, 'tema_id'=>1,   'redoslijed'=>5],//3
            ['slug'=>'kontakt',     'vrsta_sadrzaja_id'=>1, 'tema_id'=>1,   'redoslijed'=>7],//4
            ['slug'=>'pozadina-1',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1,   'redoslijed'=>20],//5
            ['slug'=>'pozadina-2',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1,   'redoslijed'=>22],//6
            ['slug'=>'pozadina-3',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1,   'redoslijed'=>24],//7
            ['slug'=>'pozadina-4',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>1,   'redoslijed'=>26],//8
            ['slug'=>'osnovne',     'vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>40],//9
            ['slug'=>'slajder-1',   'vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>42],//10
            ['slug'=>'pozadine-1',  'vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>44],//11
            ['slug'=>'prosirenje-1','vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>90],//12
            ['slug'=>'prosirenje-2','vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>90],//13
            ['slug'=>'prosirenje-3','vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>90],//14
            ['slug'=>'prosirenje-4','vrsta_sadrzaja_id'=>7, 'tema_id'=>1,   'redoslijed'=>90],//15

            ['slug'=>'pocetna',     'vrsta_sadrzaja_id'=>3, 'tema_id'=>2,   'redoslijed'=>1],//16
            ['slug'=>'o-nama',      'vrsta_sadrzaja_id'=>1, 'tema_id'=>2,   'redoslijed'=>3],//17
            ['slug'=>'smestaj',     'vrsta_sadrzaja_id'=>1, 'tema_id'=>2,   'redoslijed'=>5],//18
            ['slug'=>'rezervacije', 'vrsta_sadrzaja_id'=>1, 'tema_id'=>2,   'redoslijed'=>7],//19
            ['slug'=>'kontakt',     'vrsta_sadrzaja_id'=>3, 'tema_id'=>2,   'redoslijed'=>9],//20
            ['slug'=>'pozadina-1',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2,   'redoslijed'=>20],//21
            ['slug'=>'pozadina-2',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2,   'redoslijed'=>22],//22
            ['slug'=>'pozadina-3',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2,   'redoslijed'=>24],//23
            ['slug'=>'pozadina-4',  'vrsta_sadrzaja_id'=>6, 'tema_id'=>2,   'redoslijed'=>26],//24
            ['slug'=>'osnovne',     'vrsta_sadrzaja_id'=>7, 'tema_id'=>2,   'redoslijed'=>40],//25 galerija
            ['slug'=>'slajder-1',   'vrsta_sadrzaja_id'=>8, 'tema_id'=>2,   'redoslijed'=>42],//26 galerija
            ['slug'=>'pozadine-1',  'vrsta_sadrzaja_id'=>8, 'tema_id'=>2,   'redoslijed'=>44],//27 galerija
            ['slug'=>'pozadine-2','vrsta_sadrzaja_id'=>8, 'tema_id'=>2,   'redoslijed'=>90],//28
            ['slug'=>'prosirenje-2','vrsta_sadrzaja_id'=>7, 'tema_id'=>2,   'redoslijed'=>90],//29
            ['slug'=>'prosirenje-3','vrsta_sadrzaja_id'=>7, 'tema_id'=>2,   'redoslijed'=>90],//30
            ['slug'=>'prosirenje-4','vrsta_sadrzaja_id'=>7, 'tema_id'=>2,   'redoslijed'=>90],//31
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
                'naziv'=>'Rezervacije',
                'sadrzaj'=>'<p>Tekst je u pripremi (Rezervišite online i ostvarite bonus i popuste za naredni period).</p>',
                'icon'=>'glyphicon glyphicon-calendar',
                'templejt_id'=>3,
                'nalog_id'=>1
            ],
            [
                'naziv'=>'Kontakt',
                'sadrzaj'=>'<p>Naša tehnička podrška je aktivna 24/7 radeći na realizaciji aktuelnih zahteva korisnika, obezbeđujući i unapređujući punu funkcionalnost platforme. U tom kontekstu budite slobodni da nas kontaktirate i ostavite svoj utisak, sugestiju ili kritiku, a mi ćemo se truditi da realizujemo i prilagodimo platformu Vašim potrebama.</p>',
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
                'naziv'=>'Rezervacije',
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
                'sadrzaj'=>null,//adresa do galerije
                'icon'=>null,
                'templejt_id'=>25
            ],
            [
                'naziv'=>'Slajderi',
                'sadrzaj'=>'slajder-1',//adresa do galerije
                'icon'=>null,
                'templejt_id'=>26
            ],
            [
                'naziv'=>'Pozadine 1',
                'sadrzaj'=>'pozadine-1',//adresa do galerije
                'icon'=>null,
                'templejt_id'=>27
            ],
            [
                'naziv'=>'Pozadine 2',
                'sadrzaj'=>'pozadine-2',//adresa do galerije
                'icon'=>null,
                'templejt_id'=>28
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
            ['naziv'=>'Single','broj_osoba'=>1],
            ['naziv'=>'Dupli ležaj','broj_osoba'=>2],
            ['naziv'=>'Bračni krevet','broj_osoba'=>2],
            ['naziv'=>'Trokrevetni','broj_osoba'=>3],
            ['naziv'=>'Četvorokrevetni','broj_osoba'=>4],
            ['naziv'=>'Petokrevetni','broj_osoba'=>5],
            ['naziv'=>'Šestokrevetni','broj_osoba'=>6],
            ['naziv'=>'Sedmokrevetni','broj_osoba'=>7],
            ['naziv'=>'Osmokrevetni','broj_osoba'=>8],
            ['naziv'=>'Devetokrevetni','broj_osoba'=>9],
            ['naziv'=>'Desetokrevetni','broj_osoba'=>10],
            ['naziv'=>'Jedanestokrevetni','broj_osoba'=>11],
            ['naziv'=>'Dvanaestokrevetni','broj_osoba'=>12],
            ['naziv'=>'Trinaestokrevetni','broj_osoba'=>13]
        ]);
        DodatnaOprema::insert([
            ['naziv'=>'Bežični internet (WiFi)'],
            ['naziv'=>'Parking'],
            ['naziv'=>'TV'],
            ['naziv'=>'Hidromasažna kada'],
            ['naziv'=>'Kada'],
            ['naziv'=>'Klima uređaj'],
            ['naziv'=>'Kuhinja'],
            ['naziv'=>'Popločano dvorište'],
            ['naziv'=>'Terasa'],
            ['naziv'=>'Veš mašina'],
            ['naziv'=>'Zvučna izolacija'],
            ['naziv'=>'Čajna kuhinja'],
            ['naziv'=>'lift'],
            ['naziv'=>'Grejanje'],
            ['naziv'=>'Zabranjeno pušenje u celom objektu'],
            ['naziv'=>'Fitnes centar'],
            ['naziv'=>'Sobe za nepušače'],
            ['naziv'=>'Zatvoreni bazen'],
            ['naziv'=>'Spa i velnes centar'],
            ['naziv'=>'Otvoreni bazen'],
            ['naziv'=>'Dozvoljeni kućni ljubimci'],
            ['naziv'=>'Prilagođeno osobama sa invaliditetom'],
            ['naziv'=>'Restoran']
        ]);
    }
}