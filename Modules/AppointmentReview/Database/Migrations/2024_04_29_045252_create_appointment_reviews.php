<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('appointment_reviews')) {
            Schema::create('appointment_reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('appointment_id');
                $table->unsignedBigInteger('business_id')->default(0);
                $table->unsignedBigInteger('staff_id')->default(0);
                $table->float('review')->default('0.00');
                $table->longText('description')->nullable();
                $table->unsignedBigInteger('created_by')->default(0);
                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_reviews');
    }
};
