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
        Schema::create('information_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('information_id');
            $table->text('fullname');
            $table->timestamps();

            $table->foreign('information_id')->references('id')->on('information')->constraint()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_details');
    }
};
