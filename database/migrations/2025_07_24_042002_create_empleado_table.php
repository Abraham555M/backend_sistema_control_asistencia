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
            $table->string("nom_empleado", 200);
            $table->string("ape_empleado", 200);
            $table->date('fch_nac_empleado');
            $table->string("ema_empleado")->unique();
            $table->string("doc_empleado",8)->unique();
            $table->string("tel_empleado", 9);
            $table->text("img_empleado")->nullable(); 
            $table->integer("est_empleado")->default(1);
            $table->dateTime("fch_reg_empleado");

            $table->unsignedBigInteger('id_genero');
            $table->foreign('id_genero')->references('id_genero')->on('genero');

            $table->unsignedBigInteger('id_rol_empleado');
            $table->foreign('id_rol_empleado')->references('id_rol_empleado')->on('rol_empleado');
            
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
