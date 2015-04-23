
<?php

use Illuminate\Database\Seeder;
use App\Objekat;
use App\Smestaj;
use App\Grad;


class TestObjekat extends Seeder{
		public function run()
		{
			Grad::insert([
				
				['naziv'=>'Beograd','x'=>'20.459212','y'=>'44.806611','z'=>'10'],
				['naziv'=>'Niš','x'=>'21.991711','y'=>'43.341834','z'=>'13'],
				['naziv'=>'Užice','x'=>'19.838841','y'=>'43.855317','z'=>'13'],
				['naziv'=>'Bijeljina','x'=>'19.214315','y'=>'44.757912','z'=>'13']
				
			]);

			DB::table('objekat')->insert(
					[
						[//1
						'naziv'=>'Asteris hotel',
		            	'x'=>'44.80545',
		            	'y'=>'20.464311',
		            	'z'=>'1',
		            	'adresa'=>'50 Kralja Milana,',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'1',
		                'nalog_id' => '2'
						],
						[//2
						'naziv'=>'Green hostel',
		            	'x'=>'44.791299',
		            	'y'=>'20.491369',
		            	'z'=>'1',
		            	'adresa'=>'Gospodara Vučića',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'1',
		                'nalog_id' => '3'
						],
						[//3
						'naziv'=>'Motel Dexy',
		            	'x'=>'44.755919',
		            	'y'=>'20.42088',
		            	'z'=>'1',
		            	'adresa'=>'Ace Joksimovića',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'3',
		                'grad_id'=>'1',
		                'nalog_id' => '4'
						],
						[//4
						'naziv'=>'Naj-smeštaj',
		            	'x'=>'44.743423',
		            	'y'=>'20.502763',
		            	'z'=>'1',
		            	'adresa'=>'Gunjak',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'4',
		                'grad_id'=>'1',
		                'nalog_id' => '4'
						],//Kraj Beograd
						[//Pocetak Niš
						'naziv'=>'Nais-home',
		            	'x'=>'43.310774',
		            	'y'=>'21.925986',
		            	'z'=>'1',
		            	'adresa'=>'Jahorinska',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'2',
		                'nalog_id' => '5'
						],
						[//2
						'naziv'=>'Hostel-Jug',
		            	'x'=>'43.316273',
		            	'y'=>'21.884851',
		            	'z'=>'1',
		            	'adresa'=>'27 Novopazarska',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'2',
		                'nalog_id' => '5'
						],
						[//3
						'naziv'=>'Motel - South Paradise',
		            	'x'=>'43.331381',
		            	'y'=>'21.945856',
		            	'z'=>'1',
		            	'adresa'=>'Hrizantema',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'3',
		                'grad_id'=>'2',
		                'nalog_id' => '6'
						],
						[//4
						'naziv'=>'Javni-dom',
		            	'x'=>'43.302302',
		            	'y'=>'21.922832',
		            	'z'=>'1',
		            	'adresa'=>'128 Ljubomira Nikolića',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'4',
		                'grad_id'=>'2',
		                'nalog_id' => '6'
						],//Kraj Niš
						[//Pošetak užice
						'naziv'=>'Pleasure',
		            	'x'=>'43.853151',
		            	'y'=>'19.845622',
		            	'z'=>'1',
		            	'adresa'=>'Nikole Pašića',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'3',
		                'nalog_id' => '7'
						],
						[//2
						'naziv'=>'Hostel Sunny-valley',
		            	'x'=>'43.858031',
		            	'y'=>'19.856114',
		            	'z'=>'1',
		            	'adresa'=>'Karađorđeva',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'3',
		                'nalog_id' => '7'
						],
						[//3
						'naziv'=>'Užički raj',
		            	'x'=>'43.858588 ',
		            	'y'=>'19.829164',
		            	'z'=>'1',
		            	'adresa'=>'Ustanicka,',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'3',
		                'grad_id'=>'3',
		                'nalog_id' => '8'
						],
						[//4
						'naziv'=>'Naj-smeštaj',
		            	'x'=>'43.860567',
		            	'y'=>'19.840139',
		            	'z'=>'1',
		            	'adresa'=>'Vidovdanska	',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'4',
		                'grad_id'=>'3',
		                'nalog_id' => '8'
						],
						[//Početak Bijeljina
						'naziv'=>'Semberija',
		            	'x'=>' 44.761081',
		            	'y'=>'19.18582',
		            	'z'=>'1',
		            	'adresa'=>'Stefana Dečanskog',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'4',
		                'nalog_id' => '8'
						],
						[//2
						'naziv'=>'Posavska noć',
		            	'x'=>'44.76876',
		            	'y'=>'19.225302',
		            	'z'=>'1',
		            	'adresa'=>'Račanska',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'4',
		                'nalog_id' => '8'
						],
						[//3
						'naziv'=>'Dream',
		            	'x'=>'44.741332',
		            	'y'=>'19.222555',
		            	'z'=>'1',
		            	'adresa'=>'Srpske vojske',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'3',
		                'grad_id'=>'4',
		                'nalog_id' => '8'
						],
						[//4
						'naziv'=>'Naj-smeštaj',
		            	'x'=>'44.751939',
		            	'y'=>'19.196119',
		            	'z'=>'1',
		            	'adresa'=>'Lukijana Mušičkog',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'4',
		                'grad_id'=>'4',
		                'nalog_id' => '8'
						]

					]);
		$objekti=Objekat::get(['id','naziv'])->toArray();
		foreach($objekti as $objekat){
			Smestaj::insert([
				['naziv'=>$objekat['naziv'].'1','kapacitet_id'=>3,'vrsta_smestaja_id'=>1,'objekat_id'=>$objekat['id']],
				['naziv'=>$objekat['naziv'].'2','kapacitet_id'=>5,'vrsta_smestaja_id'=>2,'objekat_id'=>$objekat['id']],
				['naziv'=>$objekat['naziv'].'3','kapacitet_id'=>9,'vrsta_smestaja_id'=>1,'objekat_id'=>$objekat['id']],
			]);
		}
	}

}