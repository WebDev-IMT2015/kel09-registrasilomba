<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserJoinEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userJoinCompetitions', function (Blueprint $table) {
            $table->increments('id');
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary('competition_id');
            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->string('ktp_picpath');
            $table->boolean('ktp_confirmed')->default(false);
            $table->string('pdf_picpath');
            $table->boolean('pdf_confirmed')->default(false);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('userJoinCompetitions');
    }
}
