<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Input;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){
		$android=url('/').'/android';
		define('POST_STRING','najsmestaj.com:android');
		if(substr($request->url(),0,strlen($android))==$android&&Input::get('mobile_token')==POST_STRING) return parent::addCookieToResponse($request, $next($request));
		return parent::handle($request, $next);
	}

}
