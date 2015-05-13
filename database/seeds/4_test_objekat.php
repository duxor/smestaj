
<?php

use Illuminate\Database\Seeder;
use App\Objekat;
use App\Smestaj;
use App\Grad;


class TestObjekat extends Seeder{
		public function run()
		{
			Grad::insert([
				
				['naziv'=>'Beograd','x'=>20.459212,'y'=>44.806611,'z'=>10],
				['naziv'=>'Niš','x'=>21.911673545837402,'y'=>43.32378526602997,'z'=>13],
				['naziv'=>'Užice','x'=>19.838841,'y'=>43.855317,'z'=>13],
				['naziv'=>'Bijeljina','x'=>19.214315,'y'=>44.757912,'z'=>13]
			]);

			DB::table('objekat')->insert(
					[
						[//1
						'naziv'=>'Asteris hotel',
		            	'y'=>44.80545,
		            	'x'=>20.464311,
		            	'z'=>1,
		            	'adresa'=>'50 Kralja Milana,',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>1,
		                'grad_id'=>1,
		                'nalog_id' => 2
						],
						[//2
						'naziv'=>'Green hostel',
		            	'y'=>44.791299,
		            	'x'=>20.491369,
		            	'z'=>1,
		            	'adresa'=>'Gospodara Vučića',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>2,
		                'grad_id'=>1,
		                'nalog_id' => 2
						],
						[//3
						'naziv'=>'Motel Dexy',
		            	'y'=>44.755919,
		            	'x'=>20.42088,
		            	'z'=>1,
		            	'adresa'=>'Ace Joksimovića',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>3,
		                'grad_id'=>1,
		                'nalog_id' => 2
						],
						[//4
						'naziv'=>'Naj smeštaj',
		            	'y'=>44.743423,
		            	'x'=>20.502763,
		            	'z'=>1,
		            	'adresa'=>'Gunjak',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'4',
		                'grad_id'=>'1',
		                'nalog_id' => 2
						],//Kraj Beograd
						[//Pocetak Niš
						'naziv'=>'Nais home',
		            	'y'=>43.310774,
		            	'x'=>21.925986,
		            	'z'=>1,
		            	'adresa'=>'Jahorinska',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>1,
		                'grad_id'=>2,
		                'nalog_id' => 2
						],
						[//2
						'naziv'=>'Hostel Jug',
		            	'y'=>43.316273,
		            	'x'=>21.884851,
		            	'z'=>1,
		            	'adresa'=>'27 Novopazarska',
		                'aktivan' =>1,
		                'vrsta_objekta_id' =>2,
		                'grad_id'=>2,
		                'nalog_id' =>2
						],
						[//3
						'naziv'=>'Motel South Paradise',
		            	'y'=>43.331381,
		            	'x'=>21.945856,
		            	'z'=>1,
		            	'adresa'=>'Hrizantema',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>3,
		                'grad_id'=>2,
		                'nalog_id' => 2
						],
						[//4
						'naziv'=>'Javni dom',
		            	'y'=>43.302302,
		            	'x'=>21.922832,
		            	'z'=>1,
		            	'adresa'=>'128 Ljubomira Nikolića',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>4,
		                'grad_id'=>2,
		                'nalog_id' => 3
						],//Kraj Niš
						[//Pošetak užice
						'naziv'=>'Pleasure',
		            	'y'=>43.853151,
		            	'x'=>19.845622,
		            	'z'=>1,
		            	'adresa'=>'Nikole Pašića',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>1,
		                'grad_id'=>3,
		                'nalog_id' => 3
						],
						[//2
						'naziv'=>'Hostel Sunny valley',
		            	'y'=>43.858031,
		            	'x'=>19.856114,
		            	'z'=>1,
		            	'adresa'=>'Karađorđeva',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>2,
		                'grad_id'=>3,
		                'nalog_id' => 3
						],
						[//3
						'naziv'=>'Užički raj',
		            	'y'=>43.858588,
		            	'x'=>19.829164,
		            	'z'=>1,
		            	'adresa'=>'Ustanicka,',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>3,
		                'grad_id'=>3,
		                'nalog_id' => 3
						],
						[//4
						'naziv'=>'Roxy smeštaj',
		            	'y'=>43.860567,
		            	'x'=>19.840139,
		            	'z'=>1,
		            	'adresa'=>'Vidovdanska',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>4,
		                'grad_id'=>3,
		                'nalog_id' => 3
						],
						[//Početak Bijeljina
						'naziv'=>'Semberija',
		            	'y'=>44.761081,
		            	'x'=>19.18582,
		            	'z'=>1,
		            	'adresa'=>'Stefana Dečanskog',
		                'aktivan' =>1,
		                'vrsta_objekta_id' =>1,
		                'grad_id'=>4,
		                'nalog_id' => 4
						],
						[//2
						'naziv'=>'Posavska noć',
		            	'y'=>44.76876,
		            	'x'=>19.225302,
		            	'z'=>1,
		            	'adresa'=>'Račanska',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>2,
		                'grad_id'=>4,
		                'nalog_id' => 4
						],
						[//3
						'naziv'=>'Dream',
		            	'y'=>44.741332,
		            	'x'=>19.222555,
		            	'z'=>1,
		            	'adresa'=>'Srpske vojske',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>3,
		                'grad_id'=>4,
		                'nalog_id' => 4
						],
						[//4
						'naziv'=>'Palace',
		            	'y'=>44.751939,
		            	'x'=>19.196119,
		            	'z'=>1,
		            	'adresa'=>'Lukijana Mušičkog',
		                'aktivan' => 1,
		                'vrsta_objekta_id' =>4,
		                'grad_id'=>4,
		                'nalog_id' => 4
						]

					]);

			DB::table('smestaj')->insert(
			[
				[
					'naziv'=>'Asteris hotel',
					'slug'=>'hotel-asteris',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>1,
					'cena_osoba'=>2400
				],
				[
					'naziv'=>'Asteris hotel',
					'slug'=>'hotel-asteris-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>1,
					'cena_osoba'=>2100
				],
				[
					'naziv'=>'Green hostel',
					'slug'=>'hostel-green',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>'2',
					'cena_osoba'=>1400
				],
				[
					'naziv'=>'Green hostel',
					'slug'=>'hostel-green-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>2,
					'cena_osoba'=>3700
				],
				[
					'naziv'=>'Motel Dexy',
					'slug'=>'motel-dexy',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>'3',
					'cena_osoba'=>4900
				],
				[
					'naziv'=>'Motel Dexy',
					'slug'=>'motel-dexy-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>3,
					'cena_osoba'=>3750
				],
				[
					'naziv'=>'Naj smeštaj',
					'slug'=>'privatni-naj',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>4,
					'cena_osoba'=>2800
				],
				[
					'naziv'=>'Naj smeštaj',
					'slug'=>'privatni-naj-apartmani',
					'kapacitet_id'=>6,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>4,
					'cena_osoba'=>1100
				],
				[
					'naziv'=>'Nais home',
					'slug'=>'hotel-nais',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>5,
					'cena_osoba'=>4300
				],
				[
					'naziv'=>'Nais home',
					'slug'=>'hotel-nais-apartmani',
					'kapacitet_id'=>4,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>5,
					'cena_osoba'=>6800
				],
				[
					'naziv'=>'Hostel Jug',
					'slug'=>'hostel-jug',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>6,
					'cena_osoba'=>1600
				],
				[
					'naziv'=>'Hostel Jug',
					'slug'=>'hostel-jug-apartmani',
					'kapacitet_id'=>6,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>6,
					'cena_osoba'=>4300
				],
				[
					'naziv'=>'Motel South Paradise',
					'slug'=>'motel-south-paradise',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>7,
					'cena_osoba'=>3400
				],
				[
					'naziv'=>'Motel South Paradise',
					'slug'=>'motel-south-paradise-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>7,
					'cena_osoba'=>5400
				],
				[
					'naziv'=>'Javni dom',
					'slug'=>'privatni-javni',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>8,
					'cena_osoba'=>4700
				],
				[
					'naziv'=>'Javni dom',
					'slug'=>'privatni-javni-apartmani',
					'kapacitet_id'=>4,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>8,
					'cena_osoba'=>6200
				],
				[
					'naziv'=>'Pleasure',
					'slug'=>'hotel-pleasure',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>9,
					'cena_osoba'=>2600
				],
				[
					'naziv'=>'Pleasure',
					'slug'=>'hotel-pleasure-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>9,
					'cena_osoba'=>6600
				],
				[
					'naziv'=>'Hostel Sunny valley',
					'slug'=>'hostel-sunny-valley',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>10,
					'cena_osoba'=>4500
				],
				[
					'naziv'=>'Hostel Sunny valley',
					'slug'=>'hostel-sunny-valley-apartmani',
					'kapacitet_id'=>4,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>10,
					'cena_osoba'=>2500
				],
				[
					'naziv'=>'Užički raj',
					'slug'=>'motel-uzicki-raj',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>11,
					'cena_osoba'=>3200
				],
				[
					'naziv'=>'Užički raj',
					'slug'=>'motel-uzicki-raj-apartmani',
					'kapacitet_id'=>4,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>11,
					'cena_osoba'=>2700
				],
				[
					'naziv'=>'Roxy smeštaj',
					'slug'=>'privatni-roxy',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>12,
					'cena_osoba'=>3300
				],
				[
					'naziv'=>'Roxy smeštaj',
					'slug'=>'privatni-roxy-apartmani',
					'kapacitet_id'=>4,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>12,
					'cena_osoba'=>5400
				],
				[
					'naziv'=>'Semberija',
					'slug'=>'hotel-semberija',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>13,
					'cena_osoba'=>5400
				],
				[
					'naziv'=>'Semberija',
					'slug'=>'hotel-semberija-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>13,
					'cena_osoba'=>4300
				],
				[
					'naziv'=>'Posavska noć',
					'slug'=>'hostel-posavska-noc',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>14,
					'cena_osoba'=>5400
				],
				[
					'naziv'=>'Posavska noć',
					'slug'=>'hostel-posavska-noc-apartmani',
					'kapacitet_id'=>5,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>14,
					'cena_osoba'=>2400
				],
				[
					'naziv'=>'Dream',
					'slug'=>'motel-dream',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>15,
					'cena_osoba'=>2300
				],
				[
					'naziv'=>'Dream',
					'slug'=>'motel-dream-apartmani',
					'kapacitet_id'=>6,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>15,
					'cena_osoba'=>2100
				],
				[
					'naziv'=>'Palace',
					'slug'=>'privatni-palace',
					'kapacitet_id'=>3,
					'vrsta_smestaja_id'=>1,
					'objekat_id'=>16,
					'cena_osoba'=>3600
				],
				[
					'naziv'=>'Palace',
					'slug'=>'privatni-palace-apartmani',
					'kapacitet_id'=>6,
					'vrsta_smestaja_id'=>2,
					'objekat_id'=>16,
					'cena_osoba'=>4300
				]
			]);
	}

}