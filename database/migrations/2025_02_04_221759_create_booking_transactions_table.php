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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_name');
            $table->string('phone_number');
            $table->string('email');
            $table->double('total_amount');
            $table->boolean('is_paid');
            $table->integer('total_participant');
            $table->timestamp('started_at')->nullable();
            $table->string('booking_trx_id');
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
