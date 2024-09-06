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
        Schema::create('paste_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paste_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('paste_id')->references('id')->on('pastes')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paste_tag');
    }
};
