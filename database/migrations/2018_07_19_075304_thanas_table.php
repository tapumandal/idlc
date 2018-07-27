<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_bangladesh_thanas', function (Blueprint $table) {
            $table->increments('thana_id');
            $table->integer('user_id');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->string('thana_name');
            $table->integer('is_deleted')->default('0');
            $table->integer('is_active')->default('0');
            $table->string('last_action');
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
        Schema::dropIfExists('tbl_bangladesh_thanas');
    }
}
