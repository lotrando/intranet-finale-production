<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdverseventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adversevents', function (Blueprint $table) {
            $table->id();
            $table->string('department_id');
            $table->string('misto');
            $table->date('datum_cas');
            $table->time('cas');
            $table->string('spec_druh');
            $table->string('jinydoplnek')->nullable();
            $table->string('pracovnik');
            $table->string('svedek')->nullable();
            $table->string('pacient')->nullable();
            $table->date('datumnaroz')->nullable();
            $table->string('chorobopis')->nullable();
            $table->string('udalost');
            $table->string('reseni')->nullable();
            $table->string('opatreni')->nullable();
            $table->string('informovan')->nullable();
            $table->string('pricina')->nullable();
            $table->string('jina_pricina')->nullable();
            $table->string('stav_pacienta')->nullable();
            $table->string('lokalizace')->nullable();
            $table->string('druh_zraneni')->nullable();
            $table->string('preventivni_opatreni')->nullable();
            $table->string('zhodnoceni_stavu')->nullable();
            $table->date('datum')->nullable();
            $table->string('jmeno_lekare')->nullable();
            $table->string('vyvoj')->nullable();
            $table->string('upresneni')->nullable();
            $table->enum('status', ['Rozpracováno', 'Odesláno', 'Dokončeno']);
            $table->string('resitel')->nullable();
            $table->string('vyjadreni')->nullable();
            $table->string('resitel1')->nullable();
            $table->string('vyjadreni1')->nullable();
            $table->string('resitel2')->nullable();
            $table->string('vyjadreni2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adversevents');
    }
}
