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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('amount', $total = 15, $places = 2);
            $table->unsignedBigInteger('cause');
            $table->foreign('cause')->references('id')->on('causes')->onDelete('cascade');
            $table->unsignedBigInteger('donator')->nullable();
            $table->foreign('donator')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
