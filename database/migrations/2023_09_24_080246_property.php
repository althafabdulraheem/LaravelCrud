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
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('slug',255);
            $table->string('code',255);
            $table->string('price',255);
            $table->enum('currency', ['INR', 'AED'])->default('INR');
            $table->string('description',500);
            $table->string('inclusion_exclusion',500);
            $table->string('phone',255);
            $table->string('email',255);
            $table->string('img1',255);
            $table->string('img2',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
