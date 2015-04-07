<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		
		$this->call('KonfiguracioniPodaci');
		$this->call('TestPodaciAlikacije');
		$this->call('TestPodaci');
		$this->call('TestObjekat');
	}

}
