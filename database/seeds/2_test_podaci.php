
<?php

use Illuminate\Database\Seeder;


class TestPodaci extends Seeder
{

		public function run()
		{
			DB::table('korisnici')->insert
			(
			[
	            [
	            	'prezime'=>'marko',
	            	'ime'=>'markovic',
	            	'username'=>'marko@test.com',
	                'email' => 'marko@test.com',
	                'password' => Hash::make('marko'),
	                'pravapristupa_id'=>'1',
	            ],
	           	
	           	[
	            	'prezime'=>'Petrovic',
	            	'ime'=>'Petar',
	            	'username'=>'petar@test.com',
	                'email' => 'petar@test.com',
	                'password' => Hash::make('petar'),
	                'pravapristupa_id'=>'2',
	            ],

	           	[
	            	'prezime'=>'Goranovic',
	            	'ime'=>'Goran',
	            	'username'=>'goran@test.com',
	                'email' => 'goran@test.com',
	                'password' => Hash::make('goran'),
	                'pravapristupa_id'=>'3',
	            ],
	           	[
	            	'prezime'=>'Todorovic',
	            	'ime'=>'Todor',
	            	'username'=>'todor@test.com',
	                'email' => 'todor@test.com',
	                'password' => Hash::make('todor'),
	                'pravapristupa_id'=>'4',
	            ],
	           	[
	            	'prezime'=>'Ivanovic',
	            	'ime'=>'Ivan',
	            	'username'=>'ivan@test.com',
	                'email' => 'ivan@test.com',
	                'password' => Hash::make('ivan'),
	                'pravapristupa_id'=>'5',
	            ],
	           	[
	            	'prezime'=>'Stojanovic',
	            	'ime'=>'stojan',
	            	'username'=>'stojan@test.com',
	                'email' => 'stojan@test.com',
	                'password' => Hash::make('stojan'),
	                'pravapristupa_id'=>'6',
	            ],
	           	[
	            	'prezime'=>'Dejanovic',
	            	'ime'=>'Dejan',
	            	'username'=>'dejan@test.com',
	                'email' => 'dejan@test.com',
	                'password' => Hash::make('dejan'),
	                'pravapristupa_id'=>'1',
	            ],
	           	[
	            	'prezime'=>'Milosevic',
	            	'ime'=>'Milos',
	            	'username'=>'milos@test.com',
	                'email' => 'milos@test.com',
	                'password' => Hash::make('milos'),
	                'pravapristupa_id'=>'2',
	            ],
	           	[
	            	'prezime'=>'Andrijasevic',
	            	'ime'=>'Andrija',
	            	'username'=>'andrija@test.com',
	                'email' => 'andrija@test.com',
	                'password' => Hash::make('andrija'),
	                'pravapristupa_id'=>'3',
	            ],
	           	[
	            	'prezime'=>'Nenadovic',
	            	'ime'=>'Nenad',
	            	'username'=>'nenad@test.com',
	                'email' => 'nenad@test.com',
	                'password' => Hash::make('nenad'),
	                'pravapristupa_id'=>'4',
	            ]
	        ]            
	    	);

		}

}