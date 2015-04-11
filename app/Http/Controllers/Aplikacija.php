<?php namespace App\Http\Controllers;

use App\Http\Requests;

class Aplikacija extends Controller {
	public function getIndex(){

	}
	public function getObjekat($slug){
		return $slug;
	}
}
