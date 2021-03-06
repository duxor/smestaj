<?php
Route::controller('/blog','Bloger');

Route::controller('/android','Android\AndroidApi');
Route::controller('/mailer','Mailer\Mailer');

Route::controller('/{pravaSlug}/mailbox','MailboxC');
Route::controller('/{pravaSlug}/profil','Profil');
Route::controller('/{slugPrava}/galerije','Galerija');
Route::controller('/{slugPrava}/blog','Blog');
Route::get('{pravaSlug}/u-pripremi',function(){return view('u-pripremi.index');});

Route::controller('/administracija/korisnik','Administracija\Korisnik');
Route::controller('/administracija/aplikacija','Administracija\Aplikacija');
Route::controller('/administracija/nalog','Administracija\Nalozi');
Route::controller('/administracija','Administracija\Administracija');

Route::controller('/moderacija','Moderacija\Moderacija');

Route::controller('/korisnik','Korisnik\Korisnik');

Route::controller('/log','Log');
Route::get('/login','Log@getLogin');

Route::controller('/pretraga','Pretraga');
Route::controller('/aplikacija','Aplikacija');
Route::post('/rezervisi','Rezervacija@postRezervisi');
Route::controller('/rezervacija','Moderacija\Rezervacija');
Route::controller('/rezervacije','Rezervacija');


Route::get('/{slug?}','Aplikacija@getIndex');
Route::any('/{slugApp}/pretraga','Pretraga@anyIndex');
Route::get('/{slugApp}/{slugSmestaj}','Aplikacija@getSmestaj');
Route::post('/{slugApp}/{slugSmestaj}/smestaj-komentari','Aplikacija@postSmestajKomentari');


//Route::controller('/','Glavni');