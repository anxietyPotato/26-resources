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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('title',128);
            $table->string('from_city',64);
            $table->string('from_country',64);
            $table->string('to_city',64);
            $table->string('to_country',64);
            $table->integer('price');
            $table->string('status',16);
            $table->foreignId('user_id')->constrained('users')->OnDelete('cascade');
            $table->text('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
