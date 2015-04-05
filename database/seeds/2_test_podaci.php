
<?php

use Illuminate\Database\Seeder;
use App\Security;


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
	                'password' => Security::generateHashPass('marko'),
	                'pravapristupa_id'=>'1',
	                'aktivan' => 0
	            ],
	           	
	           	[
	            	'prezime'=>'Petrovic',
	            	'ime'=>'Petar',
	            	'username'=>'petar@test.com',
	                'email' => 'petar@test.com',
	                'password' =>Security::generateHashPass('petar'),
	                'pravapristupa_id'=>'2',
	                'aktivan' => 1
	            ],

	           	[
	            	'prezime'=>'Goranovic',
	            	'ime'=>'Goran',
	            	'username'=>'goran@test.com',
	                'email' => 'goran@test.com',
	                'password' => Security::generateHashPass('goran'),
	                'pravapristupa_id'=>'3',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Todorovic',
	            	'ime'=>'Todor',
	            	'username'=>'todor@test.com',
	                'email' => 'todor@test.com',
	                'password' => Security::generateHashPass('todor'),
	                'pravapristupa_id'=>'4',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Ivanovic',
	            	'ime'=>'Ivan',
	            	'username'=>'ivan@test.com',
	                'email' => 'ivan@test.com',
	                'password' => Security::generateHashPass('ivan'),
	                'pravapristupa_id'=>'5',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Stojanovic',
	            	'ime'=>'stojan',
	            	'username'=>'stojan@test.com',
	                'email' => 'stojan@test.com',
	                'password' => Security::generateHashPass('stojan'),
	                'pravapristupa_id'=>'6',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Dejanovic',
	            	'ime'=>'Dejan',
	            	'username'=>'dejan@test.com',
	                'email' => 'dejan@test.com',
	                'password' => Security::generateHashPass('dejan'),
	                'pravapristupa_id'=>'1',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Milosevic',
	            	'ime'=>'Milos',
	            	'username'=>'milos@test.com',
	                'email' => 'milos@test.com',
	                'password' => Security::generateHashPass('milos'),
	                'pravapristupa_id'=>'2',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Andrijasevic',
	            	'ime'=>'Andrija',
	            	'username'=>'andrija@test.com',
	                'email' => 'andrija@test.com',
	                'password' =>Security::generateHashPass('andrija'),
	                'pravapristupa_id'=>'3',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Nenadovic',
	            	'ime'=>'Nenad',
	            	'username'=>'nenad@test.com',
	                'email' => 'nenad@test.com',
	                'password' => Security::generateHashPass('nenad'),
	                'pravapristupa_id'=>'4',
	                'aktivan' => 1
	            ]
	        ]            
	    	);

		}

}