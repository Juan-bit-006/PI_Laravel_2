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
        Schema::table('users', function (Blueprint $table) {
            //
            // Datos del empleado
            $table->string('telefono')->nullable()->after('email');
            $table->string('especialidad')->nullable()->after('telefono');
            $table->string('turno')->nullable()->after('especialidad');

            // Estado del usuario (activo/inactivo)
            $table->enum('estado', ['activo', 'inactivo'])
                  ->default('activo')
                  ->after('turno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'telefono',
                'especialidad',
                'turno',
                'estado',
            ]);
        });
    }
};
