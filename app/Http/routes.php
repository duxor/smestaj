<?php

Route::controller('/{pravaSlug}/mailbox','MailboxC');

Route::controller('/administracija/korisnik','Administracija\Korisnik');
Route::controller('/administracija/aplikacija','Administracija\Aplikacija');
Route::controller('/administracija/nalog','Administracija\Nalozi');
Route::controller('/administracija','Administracija\Administracija');

Route::controller('/moderator/{slugApp}/galerije','Moderacija\Galerija');
Route::controller('/moderator','Moderacija\Moderacija');

Route::controller('/korisnik','Korisnik\Korisnik');

Route::controller('/log','Log');
Route::get('/login','Log@getLogin');

Route::controller('/profil','Profil');
Route::controller('/pretraga','Pretraga');
Route::controller('/aplikacija','Aplikacija');
Route::post('/rezervisi','Rezervacija@postRezervisi');
Route::controller('/rezervacija','Moderacija\Rezervacija');


Route::get('/{slug?}','Aplikacija@getIndex');
Route::any('/{slugApp}/pretraga','Pretraga@anyIndex');
Route::get('/{slugApp}/{slugSmestaj}','Aplikacija@getSmestaj');

//Route::controller('/','Glavni');