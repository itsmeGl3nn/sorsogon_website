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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('complaint');
            $table->string('mobile_num');
            $table->string('proof');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();  // Adds a nullable deleted_at column
        });
    }


    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
