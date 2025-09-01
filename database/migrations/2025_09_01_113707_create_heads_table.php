<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('heads', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('surname',50);
            $table->date('birthdate');
            $table->integer('mobile');
            $table->text('address');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->unsignedTinyInteger('marital_status');
            $table->date('mariage_date')->nullable();
            $table->text('hobbies');
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heads');
    }
};
