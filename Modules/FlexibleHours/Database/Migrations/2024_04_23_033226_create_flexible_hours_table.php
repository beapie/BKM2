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
        if (!Schema::hasTable('flexible_hours')) {
            Schema::create('flexible_hours', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('service_id');
                $table->unsignedBigInteger('staff_id');
                $table->time('start_time');
                $table->time('end_time');
                $table->string('days')->nullable();
                $table->float('price')->default(0);
                $table->unsignedBigInteger('business_id');
                $table->unsignedBigInteger('created_by')->default(0);

                $table->foreign('service_id')->references('id')->onDelete('cascade');
                $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('flexible_hours');
    }
};
