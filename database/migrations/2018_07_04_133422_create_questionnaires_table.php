<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('qst_1')->nullable();
            $table->text('qst_2')->nullable();
            $table->integer('qst_3_1')->nullable();
            $table->integer('qst_3_2')->nullable();
            $table->integer('qst_3_3')->nullable();
            $table->integer('qst_3_4')->nullable();
            $table->integer('qst_3_5')->nullable();
            $table->integer('qst_3_6')->nullable();
            $table->string('qst_4')->nullable();
            $table->text('qst_4_desc')->nullable();
            $table->text('qst_5')->nullable();
            $table->text('qst_6')->nullable();
            $table->text('qst_7')->nullable();
            $table->text('qst_8')->nullable();
            $table->text('qst_9')->nullable();
            $table->text('qst_10')->nullable();
            $table->text('qst_11')->nullable();
            $table->text('qst_12')->nullable();
            $table->text('qst_13')->nullable();
            $table->text('qst_14')->nullable();
            $table->text('qst_15')->nullable();
            $table->text('qst_16')->nullable();
            $table->text('qst_17')->nullable();
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
        Schema::dropIfExists('questionnaires');
    }
}
