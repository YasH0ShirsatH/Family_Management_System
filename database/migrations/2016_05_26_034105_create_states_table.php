<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fips_code')->nullable();
            $table->string('iso2')->nullable();
            $table->string('iso3166_2')->nullable();
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('native')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('timezone')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->enum('status', ['0', '1', '9'])->default('1'); // Defines an enum column named 'status'
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
        Schema::dropIfExists('states');
    }
}
