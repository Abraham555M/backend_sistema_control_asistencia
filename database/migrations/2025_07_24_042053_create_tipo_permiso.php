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
        Schema::create('tipo_permiso', function (Blueprint $table) {
            $table->id("id_tipo_permiso");
            $table->string("nom_tipo_permiso");
            $table->boolean("est_tipo_permiso")->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_permiso');
    }
};
