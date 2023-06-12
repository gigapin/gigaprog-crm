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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('appearance')->nullable();
            $table->string('destination')->nullable();
            $table->string('dock')->nullable();
            $table->string('pickup_date')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->unsignedInteger('number_packs')->nullable();
            $table->unsignedInteger('delivery_cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
