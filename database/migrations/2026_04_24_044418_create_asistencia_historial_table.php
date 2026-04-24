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
        Schema::create('asistencia_historial', function (Blueprint $table) {
            $table->id('id_asistencia_historial');
            $table->date('fch_asistencia_historial');
            $table->time('hor_tra_asistencia_historial')->nullable();
            $table->decimal('horas_trabajadas_totales', 5, 2)->nullable();

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
        Schema::dropIfExists('asistencia_historial');
    }
};
