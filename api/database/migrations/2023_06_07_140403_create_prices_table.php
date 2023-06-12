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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->decimal('purchase_price');
            $table->tinyInteger('purchase_vat')->nullable();
            $table->decimal('trade_price')->nullable();
            $table->tinyInteger('trade_vat')->nullable();
            $table->decimal('offer_price')->nullable();
            $table->text('note')->nullable();
            $table->string('currency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
