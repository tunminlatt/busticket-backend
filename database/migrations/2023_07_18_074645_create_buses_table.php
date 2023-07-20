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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->integer('seating_capacity');
            $table->unsignedBigInteger('from')->nullable();
            $table->unsignedBigInteger('to')->nullable();
            $table->timestamps();

            $table->foreign('from')->references('id')->on('destinations')->onDelete('set null');
            $table->foreign('to')->references('id')->on('destinations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
