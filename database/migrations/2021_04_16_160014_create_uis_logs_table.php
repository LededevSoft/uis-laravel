<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUisLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uis_logs', function (Blueprint $table) {
            $table->id();
            $table->string("source");
            $table->string("event");
            $table->string("status");
            $table->json("data")->nullable(true);
            $table->timestamp("created_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uis_logs');
    }
}
