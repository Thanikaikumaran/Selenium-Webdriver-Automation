<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_parts', function (Blueprint $table) {
            $table->integer('parts_id')->unique();
            $table->string('name');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('vehicle_has_parts', function (Blueprint $table) {
            $table->integer('parts_id');
            $table->integer('vehicle_id');
            $table->timestamps();
            $table->foreign('parts_id')
                ->references('parts_id')
                ->on('vehicle_parts')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('vehicle_id')
                ->references('vehicle_id')
                ->on('vehicles')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['parts_id', 'vehicle_id'], 'vehicle_has_parts_parts_id_vehicle_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_parts');
        Schema::dropIfExists('vehicle_has_parts');
    }
}
