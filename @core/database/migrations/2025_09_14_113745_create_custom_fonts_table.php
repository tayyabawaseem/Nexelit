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
        Schema::create('custom_fonts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // font name e.g. "Roboto"
            $table->json('variants')->nullable(); // ["0,400","0,700","1,400italic"]
            $table->enum('type', ['google', 'uploaded'])->default('google');
            $table->string('file_path')->nullable(); // only if uploaded fonts are supported
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fonts');
    }
};
