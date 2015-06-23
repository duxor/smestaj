<?php namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
class AndroidApi extends Controller {
	public function anyIndex(){
		$_POST['_token']=csrf_token();
		return Redirect::to(Input::get('url'))->withInput(Input::All());
	}
    public function getTest(){
        return view('test',['podaci'=>[]]);
    }
}
