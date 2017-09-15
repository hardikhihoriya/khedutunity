<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalukaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ku_taluka', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taluka_name', 255)->nullable();
            $table->string('district_code', 10);
            $table->tinyInteger('district_id');
            $table->string('taluka_image', 255)->nullable();
            $table->string('taluka_description', 255)->nullalbe();
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
         Schema::dropIfExists('ku_taluka');
    }

}
