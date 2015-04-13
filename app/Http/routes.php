<?php

Route::controller('/administracija/korisnik','Administracija\Korisnik');
Route::controller('/administracija/aplikacija','Administracija\Aplikacija');
Route::controller('/administracija/nalog','Administracija\Nalozi');
Route::controller('/administracija','Administracija\Administracija');

Route::controller('/log','Log');
Route::controller('/profil','Profil');
Route::controller('/pretraga','Pretraga');
Route::controller('/aplikacija','Aplikacija');

Route::controller('/','Glavni');