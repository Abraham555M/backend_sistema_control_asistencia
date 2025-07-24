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
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id("id_asistencia");
            $table->time("hor_asistencia"); // hora de ingreso
            $table->decimal("hor_tot_asistencia", 5, 2); // horas totales trabajadas
            $table->enum("est_asistencia", ['puntual', 'tardanza', 'falta'])->default('puntual');
            $table->text("obs_asistencia")->nullable(); //observacion

            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
