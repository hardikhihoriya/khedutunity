<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('contact_email', 255)->nullable();
            $table->string('contact_subject', 255)->nullable();
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
    public function down() {
        Schema::dropIfExists('contact');
    }

}
