<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            // Login asignado (opcional)
            $table->unsignedBigInteger('user_id')->nullable();

            // Datos laborales
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('telefono')->nullable();
            $table->string('especialidad')->nullable();
            $table->string('turno')->nullable();
            
            // Estado laboral (empleado activo / inactivo)
            $table->boolean('estado_empleado')->default(1);

            $table->date('fecha_ingreso')->nullable();

            // Relación con tabla users
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->nullOnDelete(); // Si se borra login, empleado sigue

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
