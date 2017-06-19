<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserJoinEventAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->integer('participants_id')->unsigned();
            $table->integer('attachment_no');
            $table->string('attachment_path');
            $table->boolean('attachment_confirmed')->default(false);
            $table->timestamps();

            $table->primary(['participants_id', 'attachment_no']);
            
            $table->foreign('participants_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
