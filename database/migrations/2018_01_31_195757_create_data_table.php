<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('chest', 8, 2)->nullable();
            $table->decimal('abdominal', 8, 2)->nullable();
            $table->decimal('abdomen', 8, 2)->nullable();
            $table->decimal('thigh', 8, 2)->nullable();
            $table->decimal('bicep', 8, 2)->nullable();
            $table->decimal('tricep', 8, 2)->nullable();
            $table->decimal('subscapular', 8, 2)->nullable();
            $table->decimal('suprailiac', 8, 2)->nullable();
            $table->decimal('lower_back', 8, 2)->nullable();
            $table->decimal('calf', 8, 2)->nullable();
            $table->decimal('midaxillary', 8, 2)->nullable();
            $table->decimal('neck', 8, 2)->nullable();
            $table->decimal('bodyweight', 8, 2)->nullable();
            $table->decimal('waist', 8, 2)->nullable();
            $table->decimal('hips', 8, 2)->nullable();
            $table->integer('height_integer')->nullable();
            $table->integer('height_decimal')->nullable();
            $table->string('metric_system')->nullable();
            $table->decimal('jp7', 8, 2)->nullable();
            $table->decimal('pcm', 8, 2)->nullable();
            $table->decimal('ntm', 8, 2)->nullable();
            $table->date('calculation_date')->nullable();
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
        Schema::dropIfExists('data');
    }
}
