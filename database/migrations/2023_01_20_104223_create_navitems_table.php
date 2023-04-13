<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navitems', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->integer('category_id');
            $table->string('name');
            $table->string('subname');
            $table->string('alt_name');
            $table->string('tooltip');
            $table->string('color');
            $table->string('page_title');
            $table->string('route');
            $table->string('favicon');
            $table->string('fa_icon');
            $table->text('svg_icon');
            $table->string('icon_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navitems');
    }
}
