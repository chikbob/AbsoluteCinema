<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained()->onDelete('cascade');
            $table->integer('row_number');
            $table->integer('seat_number');
            $table->enum('seat_type', ['standard', 'vip', 'disabled', 'sofa']);
            $table->enum('status', ['available', 'reserved', 'sold', 'unavailable'])->default('available');
            $table->decimal('price', 8, 2)->default(0); // Убрали `after('status')`
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
