<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->integer('vehicle_id')->unique();
            $table->string('bike_producer',100);
            $table->string('series',100);
            $table->string('size')->nullable();
            $table->string('configuration',100)->nullable();
            $table->string('bike_model',100);
            $table->string('sales_name',100)->nullable();
            $table->smallInteger('year')->nullable();
            $table->integer('cylinder')->default(0);
            $table->string('type_of_drive',100)->nullable();
            $table->string('engine_output')->nullable();
            $table->string('country',50)->nullable();
            $table->string('category_one',50)->nullable();
            $table->string('category_two',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
