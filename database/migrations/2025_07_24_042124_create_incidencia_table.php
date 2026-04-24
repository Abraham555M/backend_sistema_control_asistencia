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
        Schema::create('incidencia', function (Blueprint $table) {
            $table->id("id_incidencia");
            $table->date("fch_incidencia");
            $table->text("des_incidencia")->nullable();
            $table->tinyInteger("est_incidencia")->default(1);

            $table->unsignedBigInteger('id_tipo_incidencia');
            $table->foreign('id_tipo_incidencia')->references('id_tipo_incidencia')->on('tipo_incidencia');

            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleado');

            $table->unsignedBigInteger('id_empleado_revision');
            $table->foreign('id_empleado_revision')->references('id_empleado')->on('empleado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencia');
    }
};
