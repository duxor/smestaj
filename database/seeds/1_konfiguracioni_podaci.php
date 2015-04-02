<?php
use Illuminate\Database\Seeder;
use App\Security;
use App\PravaPristupa;
use App\Korisnici;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
        $pravaPristupa = [
            [
                'naziv' => 'Zabranjen pristup'
            ],
            [
                'naziv' => 'Gost'
            ],
            [
                'naziv' => 'Analitičar'
            ],
            [
                'naziv' => 'Administrator'
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
                'pravapristupa_id' => 1
            ],
            [
                'prezime' => 'Administrator',
                'ime' => 'Administrator',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => Security::generateHashPass('admin'),
                'pravapristupa_id' => 4
            ]
        ];
        Korisnici::insert($korisnici);
    }
}