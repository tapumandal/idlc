<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_bangladesh_bank', function (Blueprint $table) {
            $table->increments('bank_id');
            $table->integer('user_id');
            $table->string('bank_name');
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
        Schema::dropIfExists('tbl_bangladesh_bank');
    }
}
