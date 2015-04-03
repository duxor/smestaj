<?php
use Illuminate\Database\Seeder;
use App\Security;
use App\PravaPristupa;
use App\Korisnici;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
        $pravaPristupa = [
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
        ];
        PravaPristupa::insert($pravaPristupa);

        $korisnici = [
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
        ];
        Korisnici::insert($korisnici);
    }
}