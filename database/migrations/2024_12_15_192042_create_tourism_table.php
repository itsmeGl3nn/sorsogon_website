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
        Schema::create('tourism', function (Blueprint $table) {
            $table->id(); // ID column (primary key)
            $table->string('title');
            $table->string('desc');
            $table->string('image'); // Image column for storing image paths or URLs// Title column
            $table->timestamps(); // Created and updated timestamps

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism');
    }
};
