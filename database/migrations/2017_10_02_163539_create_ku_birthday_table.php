<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuBirthdayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ku_birthday', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('birthday_email', 255)->nullable();
            $table->timestamp('birthdate')->nullable();
            $table->string('birthdayImage', 255)->nullable();
            $table->string('tagline', 255)->nullable();
            $table->longText('address')->nullable();
            $table->longText('message')->nullalbe();
            $table->tinyInteger('status')->comment('0 - Inactive , 1 - Active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('ku_birthday');
    }
}
