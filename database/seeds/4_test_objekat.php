
<?php

use Illuminate\Database\Seeder;
use App\Security;
use App\VrstaObjekta;
use App\Grad;
use App\Objekat;



class TestObjekat extends Seeder
{

		public function run()
		{
			DB::table('vrsta_objekta')->insert(
				[
					['naziv'=>'Hotel'],
					['naziv'=>'Privatni smeštaj'],
				]
				);
			DB::table('grad')->insert(
					[
						['naziv'=>'Beograd'],
						['naziv'=>'Foča'],
						['naziv'=>'Brčko'],
						
					]
				);

			DB::table('objekat')->insert(
					[
						[//1
						'naziv'=>'Penthaus-Jović',
		            	'x'=>'44.908025',
		            	'y'=>'20.385132',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'1',
		                'nalog_id' => '3'
						],
						[//3
						'naziv'=>'Vila labudovo jezero',
		            	'x'=>'44.696676',
		            	'y'=>'20.541',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'1',
		                'nalog_id' => '3'
						],
						[//3
						'naziv'=>'Stadion',
		            	'x'=>'44.74805',
		            	'y'=>'20.478172',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'1',
		                'nalog_id' => '3'
						],
						[//4
						'naziv'=>'marko',
		            	'x'=>'43.505478',
		            	'y'=>'18.777265',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'2',
		                'nalog_id' => '4'
						],
						[//5
						'naziv'=>'Penthaus-Foča',
		            	'x'=>'43.499607',
		            	'y'=>'18.759499',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'2',
		                'nalog_id' => '4'
						],
						[//6
						'naziv'=>'Penthaus_Foča2',
		            	'x'=>'43.502172',
		            	'y'=>'18.779926',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'2',
		                'nalog_id' => '4'
						],
						[//7
						'naziv'=>'Penthaus-Brčko',
		            	'x'=>'44.872656 ',
		            	'y'=>'18.810628',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'2',
		                'grad_id'=>'3',
		                'nalog_id' => '4'
						],
						[//8
						'naziv'=>'Penthaus-Brčko2',
		            	'x'=>'44.875664',
		            	'y'=>'18.803701',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'3',
		                'nalog_id' => '3'
						],
						[//9
						'naziv'=>'Penthaus-Brčko3',
		            	'x'=>'44.875682',
		            	'y'=>'18.808122',
		                'aktivan' => '1',
		                'vrsta_objekta_id' =>'1',
		                'grad_id'=>'3',
		                'nalog_id' => '3'
						],

					]


				);
	}

}