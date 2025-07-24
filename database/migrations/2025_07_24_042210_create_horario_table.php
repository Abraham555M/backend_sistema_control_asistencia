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
        Schema::create('horario', function (Blueprint $table) {
            $table->id("id_horario");
            $table->string(column: "hor_lun_horario");
            $table->string(column: "hor_mar_horario");
            $table->string(column: "hor_mie_horario");
            $table->string(column: "hor_jue_horario");
            $table->string(column: "hor_vie_horario");
            $table->string(column: "hor_sab_horario");
            $table->string(column: "hor_dom_horario");
            $table->decimal("hor_sem_horario", 5, 2)->nullable();
            $table->integer("dia_sem_horario"); // Cantidad de dias de trabajo
            $table->integer("est_horario")->default(1);

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
        Schema::dropIfExists('horario');
    }
};
