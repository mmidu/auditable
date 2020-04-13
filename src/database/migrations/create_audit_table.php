<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table');
            $table->string('model');
            $table->string('action')->nullable();
            $table->string('field')->nullable();
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();
            $table->string('user');
            $table->timestamp('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit');
    }
}
