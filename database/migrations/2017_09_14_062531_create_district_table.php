<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ku_district',function (Blueprint $table){
            $table->increments('id');
            $table->string('district_name',255)->nullable();
            $table->string('district_code',6)->nullable();
            $table->string('state_code',6)->nullable();
            $table->string('district_image',255)->nullable();
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
        //
        Schema::dropIfExists('ku_district');
    }
}
