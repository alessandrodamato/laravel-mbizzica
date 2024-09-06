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
        Schema::create('pastes', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('title')->nullable();
            $table->tinyInteger('visibility'); // gestisco la visibilità con 1,2,3 assegnando ad ognuno una specifica funzione (pubblico, privato, non elencato)
            $table->date('expiration_date')->nullable();
            $table->string('password', 32)->nullable(); // hash della password
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastes');
    }
};
