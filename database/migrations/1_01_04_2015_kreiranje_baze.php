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
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('kapacitet', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45)->nullable();
            $table->unsignedInteger('broj_kreveta')->nullable();
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
            $table->unsignedBigInteger('tema_id')->default(1);
            $table->foreign('tema_id')->references('id')->on('tema');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('objekat', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->string('x', 45)->nullable();
            $table->string('y', 45)->nullable();
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
            $table->unsignedBigInteger('kapacitet_id');
            $table->foreign('kapacitet_id')->references('id')->on('kapacitet');
            $table->unsignedBigInteger('vrsta_smestaja_id');
            $table->foreign('vrsta_smestaja_id')->references('id')->on('vrsta_smestaja');
            $table->unsignedBigInteger('objekat_id');
            $table->foreign('objekat_id')->references('id')->on('objekat');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('sadrzaji', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->text('sadrzaj');
            $table->unsignedBigInteger('templejt_id');
            $table->unsignedBigInteger('nalog_id');
            $table->foreign('nalog_id')->references('id')->on('nalog');
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

    }
    public function down()
    {
        Schema::drop('log');
        Schema::drop('pass_reset');
        Schema::drop('smestaj');
        Schema::drop('vrsta_smestaja');
        Schema::drop('kapacitet');
        Schema::drop('objekat');
        Schema::drop('vrsta_objekta');
        Schema::drop('grad');
        Schema::drop('sadrzaji');
        Schema::drop('nalog');
        Schema::drop('templejt');
        Schema::drop('tema');
        Schema::drop('vrsta_sadrzaja');

        Schema::drop('korisnici');
        Schema::drop('pravaPristupa');
    }
}