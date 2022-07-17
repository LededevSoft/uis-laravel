<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUisAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uis_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('access_token')->nullable();
            $table->mediumText('login')->nullable();
			$table->mediumText('pass')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uis_apps');
    }
}
