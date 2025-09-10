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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('head_id')->constrained('heads')->onDelete('cascade');
            $table->string('name');
            $table->date('birthdate');
            $table->unsignedTinyInteger('marital_status');
            $table->date('mariage_date')->nullable();
            $table->string('education')->nullable();
            $table->string('photo_path')->nullable();
            $table->enum('status', ['0', '1', '9'])->default('1'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
