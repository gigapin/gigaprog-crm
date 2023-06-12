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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('roles')->insert([
            'name' => 'Administrator',
            'slug' => 'administrator'
        ]);
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            'name' => 'Warehouse',
            'slug' => 'warehouse'
        ]);
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            'name' => 'Business',
            'slug' => 'business'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
