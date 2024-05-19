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
        if (!Schema::hasTable('contact_us')) {
            Schema::create('contact_us', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('contact');
                $table->string('subject');
                $table->string('description');
                $table->string('theme');
                $table->unsignedBigInteger('business_id')->default(0);
                $table->timestamps();

                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
