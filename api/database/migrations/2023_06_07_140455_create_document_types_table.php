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
        Schema::create('documents_type', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        DB::table('documents_type')->insert([
            'type' => 'receipt'
        ]);
        DB::table('documents_type')->insert([
            'type' => 'invoice'
        ]);
        DB::table('documents_type')->insert([
            'type' => 'transport document'
        ]);
        DB::table('documents_type')->insert([
            'type' => 'credit note'
        ]);
        DB::table('documents_type')->insert([
            'type' => 'estimate'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
