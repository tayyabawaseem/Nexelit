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
        Schema::dropIfExists('custom_fonts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('custom_fonts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('variants')->nullable();
            $table->string('type')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }
};
