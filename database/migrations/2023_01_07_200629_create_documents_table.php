<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('accordion_name');
            $table->integer('accordion_group')->nullable();
            $table->integer('position');
            $table->integer('document_position');
            $table->string('document_name');
            $table->string('description');
            $table->string('year')->nullable();
            $table->string('processed')->nullable();
            $table->string('authorize')->nullable();
            $table->string('examine')->nullable();
            $table->date('efficiency')->nullable();
            $table->string('revision');
            $table->date('revision_date')->nullable();
            $table->date('next_revision_date')->nullable();
            $table->string('tags')->nullable();
            $table->string('file');
            $table->string('unique_code')->nullable();
            $table->enum('status', ['Schváleno', 'Rozpracováno']);
            $table->integer('user_id');
            $table->integer('onscreen');
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
        Schema::dropIfExists('documents');
    }
}
