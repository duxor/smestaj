
<?php

use Illuminate\Database\Seeder;
use App\Security;
use App\Korisnici;

class TestPodaciKorisnici extends Seeder
{

		public function run()
		{
			Korisnici::insert([
				[

					'prezime'=>'korisnik',
					'ime'=>'korisnik',
					'username'=>'korisnik',
					'email' => 'korisnik@korisnik.korisnik',
					'password' => Security::generateHashPass('korisnik'),
					'pravapristupa_id'=>2,
					'aktivan' => 1
				],
				[

					'prezime'=>'moderator',
					'ime'=>'moderator',
					'username'=>'moderator',
					'email' => 'mod@mod.mod',
					'password' => Security::generateHashPass('moderator'),
					'pravapristupa_id'=>4,
					'aktivan' => 1
				],
				[

					'prezime'=>'marko',
					'ime'=>'markovic',
					'username'=>'marko',
					'email' => 'marko@test.com',
					'password' => Security::generateHashPass('marko'),
					'pravapristupa_id'=>1,
					'aktivan' => 0
				],
	           	
	           	[
	            	'prezime'=>'Petrovic',
	            	'ime'=>'Petar',
	            	'username'=>'petar',
	                'email' => 'petar@test.com',
	                'password' =>Security::generateHashPass('petar'),
	                'pravapristupa_id'=>2,
	                'aktivan' => 1
	            ],

	           	[
	            	'prezime'=>'Goranovic',
	            	'ime'=>'Goran',
	            	'username'=>'goran',
	                'email' => 'goran@test.com',
	                'password' => Security::generateHashPass('goran'),
	                'pravapristupa_id'=>3,
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Todorovic',
	            	'ime'=>'Todor',
	            	'username'=>'todor',
	                'email' => 'todor@test.com',
	                'password' => Security::generateHashPass('todor'),
	                'pravapristupa_id'=>4,
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Ivanovic',
	            	'ime'=>'Ivan',
	            	'username'=>'ivan',
	                'email' => 'ivan@test.com',
	                'password' => Security::generateHashPass('ivan'),
	                'pravapristupa_id'=>'2',
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Stojanovic',
	            	'ime'=>'stojan',
	            	'username'=>'stojan',
	                'email' => 'stojan@test.com',
	                'password' => Security::generateHashPass('stojan'),
	                'pravapristupa_id'=>6,
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Dejanovic',
	            	'ime'=>'Dejan',
	            	'username'=>'dejan',
	                'email' => 'dejan@test.com',
	                'password' => Security::generateHashPass('dejan'),
	                'pravapristupa_id'=>1,
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Milosevic',
	            	'ime'=>'Milos',
	            	'username'=>'milos',
	                'email' => 'milos@test.com',
	                'password' => Security::generateHashPass('milos'),
	                'pravapristupa_id'=>2,
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Andrijasevic',
	            	'ime'=>'Andrija',
	            	'username'=>'andrija',
	                'email' => 'andrija@test.com',
	                'password' =>Security::generateHashPass('andrija'),
	                'pravapristupa_id'=>3,
	                'aktivan' => 1
	            ],
	           	[
	            	'prezime'=>'Nenadovic',
	            	'ime'=>'Nenad',
	            	'username'=>'nenad',
	                'email' => 'nenad@test.com',
	                'password' => Security::generateHashPass('nenad'),
	                'pravapristupa_id'=>4,
	                'aktivan' => 1
	            ]
	        ]);

		}

}