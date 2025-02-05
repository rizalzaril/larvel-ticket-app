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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name_tickets');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('path_video');
            $table->text('about');
            $table->unsignedBigInteger('price');
            $table->string('address');
            $table->boolean('is_popular');
            $table->timestamp('open_time_at')->nullable();  // Perbaikan
            $table->timestamp('closed_time_at')->nullable(); // Perbaikan
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('seller_id')->constrained()->cascadeOnDelete();
            $table->timestamps(); // Hanya satu kali
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
