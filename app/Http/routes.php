<?php

Route::controller('/administracija/korisnik','Administracija\Korisnik');
Route::controller('/administracija/aplikacija','Administracija\Aplikacija');
Route::controller('/administracija/nalog','Administracija\Nalozi');
Route::controller('/administracija','Administracija\Administracija');

Route::controller('/moderator','Moderacija\Moderacija');

Route::controller('/korisnik','Korisnik\Korisnik');

Route::controller('/log','Log');
Route::get('/login','Log@getLogin');

Route::controller('/profil','Profil');
Route::controller('/pretraga','Pretraga');
Route::controller('/aplikacija','Aplikacija');

Route::get('/{slug?}','Aplikacija@getIndex');

//Route::controller('/','Glavni');