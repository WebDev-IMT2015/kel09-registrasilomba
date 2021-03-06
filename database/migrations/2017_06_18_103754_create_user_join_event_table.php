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
        Schema::create('participants', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->string('ktp_picpath');
            $table->boolean('ktp_confirmed')->default(false);
            $table->string('pdf_picpath');
            $table->boolean('pdf_confirmed')->default(false);
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->primary(['id', 'user_id', 'competition_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('competition_id')->references('id')->on('competitions');
        });

         DB::statement('ALTER TABLE participants MODIFY COLUMN id int(10) unsigned auto_increment');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
