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
        Schema::create('stores', function (Blueprint $table) {
            $table->uuid()->primary();
            // $table->id();
            $table->foreignUuid('user_id');
            $table->text('name')->unique();
            $table->text('logo')->nullable();
            $table->text('address');
            $table->string('contact');
            $table->text('description')->nullable();
            $table->string('VA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
