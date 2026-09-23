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
        Schema::create('custom_font_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file');
            $table->string('path')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_font_imports');
    }
};
