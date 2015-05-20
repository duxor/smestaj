<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 4/1/2015
 * Time: 11:51 PM
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class KreiranjeBaze extends Migration{
    public function up(){
        Schema::create('pravapristupa', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('korisnici', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('prezime', 45)->nullable();
            $table->string('ime', 45)->nullable();
            $table->string('username', 45)->unique();
            $table->string('email', 45)->unique();
            $table->string('password', 150);
            $table->string('token', 250)->nullable();
            $table->tinyInteger('aktivan')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('pravapristupa_id');
            $table->foreign('pravapristupa_id')->references('id')->on('pravapristupa');
            $table->string('adresa', 250)->nullable();
            $table->string('grad', 45)->nullable();
            $table->string('telefon', 45)->nullable();
            $table->string('fotografija', 255)->nullable();
        });
        Schema::create('log', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
        });
        Schema::create('pass_reset', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('token',250);
            $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
        });
        Schema::create('mailbox', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->unsignedBigInteger('od_id')->nullable();
            $table->string('od_email', 45)->nullable();
            $table->string('telefon', 45)->nullable();
            $table->string('naslov', 45)->nullable();
            $table->text('poruka');
            $table->tinyInteger('procitano')->default(0);
            $table->tinyInteger('aktivan')->default(1);
            $table->tinyInteger('copy')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_objekta', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('grad', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->string('x',45)->nullable();
            $table->string('y',45)->nullable();
            $table->tinyInteger('z')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('kapacitet', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->nullable();
            $table->unsignedInteger('broj_osoba')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_smestaja', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('tema', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('slug',45)->unique();
            $table->string('naziv', 45);
            $table->text('opis')->nullable();
            $table->tinyInteger('aktivan')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('nalog', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->string('slug', 45)->unique();
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->unsignedBigInteger('tema_id')->default(2);
            $table->foreign('tema_id')->references('id')->on('tema');
            $table->tinyInteger('saradnja')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('newsletter', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('token', 250);
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->unsignedBigInteger('nalog_id')->default(1);
            $table->foreign('nalog_id')->references('id')->on('nalog');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('objekat', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->text('opis')->nullable();
            $table->string('x', 45)->nullable();
            $table->string('y', 45)->nullable();
            $table->string('z', 45)->nullable()->default(1);
            $table->string('adresa', 45)->nullable();
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('vrsta_objekta_id');
            $table->foreign('vrsta_objekta_id')->references('id')->on('vrsta_objekta');
            $table->unsignedBigInteger('grad_id');
            $table->foreign('grad_id')->references('id')->on('grad');
            $table->unsignedBigInteger('nalog_id');
            $table->foreign('nalog_id')->references('id')->on('nalog');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('smestaj', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->string('slug', 45)->unique();
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('kapacitet_id');
            $table->foreign('kapacitet_id')->references('id')->on('kapacitet');
            $table->unsignedBigInteger('vrsta_smestaja_id');
            $table->foreign('vrsta_smestaja_id')->references('id')->on('vrsta_smestaja');
            $table->unsignedBigInteger('objekat_id');
            $table->foreign('objekat_id')->references('id')->on('objekat');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->string('naslovna_foto', 255)->nullable();
            $table->float('cena_osoba')->nullable();
        });
        Schema::create('dodatna_oprema', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->text('opis')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('dodatno', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('smestaj_id');
            $table->foreign('smestaj_id')->references('id')->on('smestaj');
            $table->unsignedBigInteger('dodatna_oprema_id');
            $table->foreign('dodatna_oprema_id')->references('id')->on('dodatna_oprema');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('sadrzaji', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->text('sadrzaj');
            $table->string('icon', 45)->nullable();
            $table->unsignedBigInteger('templejt_id');
            $table->unsignedBigInteger('nalog_id');
            $table->foreign('nalog_id')->references('id')->on('nalog');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('lista_zelja', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->tinyInteger('aktivan')->default(1);
            $table->unsignedBigInteger('smestaj_id');
            $table->foreign('smestaj_id')->references('id')->on('smestaj');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('komentari', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->text('komentar');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->unsignedBigInteger('smestaj_id');
            $table->foreign('smestaj_id')->references('id')->on('smestaj');
            $table->tinyInteger('ocena')->nullable();
            $table->tinyInteger('aktivan')->default(0);
            $table->unsignedBigInteger('odgovor_za_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_sadrzaja', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('templejt', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->integer('redoslijed')->default(10);
            $table->string('slug', 45);
            $table->unsignedBigInteger('vrsta_sadrzaja_id');
            $table->foreign('vrsta_sadrzaja_id')->references('id')->on('vrsta_sadrzaja');
            $table->unsignedBigInteger('tema_id');
            $table->foreign('tema_id')->references('id')->on('tema');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('default_sadrzaji', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->text('sadrzaj');
            $table->string('icon', 45)->nullable();
            $table->unsignedBigInteger('templejt_id');
            $table->foreign('templejt_id')->references('id')->on('templejt');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('rezervacije', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->dateTime('od');
            $table->dateTime('do');
            $table->tinyInteger('broj_osoba');
            $table->float('cena_ukupna');
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
            $table->unsignedBigInteger('smestaj_id');
            $table->foreign('smestaj_id')->references('id')->on('smestaj');
            $table->text('napomena')->nullable();
            $table->tinyInteger('aktivan')->default(1);
            $table->date('odjava')->nullable();
            $table->text('utisci')->nullable();
            $table->tinyInteger('ocena')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

    }
    public function down()
    {
        Schema::drop('log');
        Schema::drop('pass_reset');
        Schema::drop('rezervacije');
        Schema::drop('lista_zelja');
        Schema::drop('komentari');
        Schema::drop('dodatno');
        Schema::drop('dodatna_oprema');
        Schema::drop('smestaj');
        Schema::drop('vrsta_smestaja');
        Schema::drop('kapacitet');
        Schema::drop('objekat');
        Schema::drop('vrsta_objekta');
        Schema::drop('grad');
        Schema::drop('sadrzaji');
        Schema::drop('default_sadrzaji');
        Schema::drop('newsletter');
        Schema::drop('nalog');
        Schema::drop('templejt');
        Schema::drop('tema');
        Schema::drop('vrsta_sadrzaja');

        Schema::drop('mailbox');
        Schema::drop('korisnici');
        Schema::drop('pravaPristupa');
    }
}