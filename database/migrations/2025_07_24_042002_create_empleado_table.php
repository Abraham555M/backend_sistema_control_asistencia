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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id("id_empleado");
            $table->string(column: "nom_empleado");
            $table->string("ape_empleado");
            $table->string("ema_empleado")->unique();
            $table->string("doc_empleado",8)->unique();
            $table->string("tel_empleado", 9);
            $table->integer("est_empleado")->default(1);
            $table->date("fch_reg_empleado");

            $table->unsignedBigInteger('id_genero');
            $table->foreign('id_genero')->references('id_genero')->on('genero');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
