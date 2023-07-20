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
        Schema::create('seat_ids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seating_plan_id');
            $table->string('seat_number');
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->foreign('seating_plan_id')->references('id')->on('seating_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_ids');
    }
};
