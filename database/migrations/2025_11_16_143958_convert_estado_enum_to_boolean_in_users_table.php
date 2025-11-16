<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Crear columna temporal BOOLEAN
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('estado_tmp')->default(1);
        });

        // 2. Migrar datos de enum → booleano
        DB::statement("UPDATE users SET estado_tmp = 1 WHERE estado = 'activo'");
        DB::statement("UPDATE users SET estado_tmp = 0 WHERE estado = 'inactivo'");

        // 3. Eliminar columna antigua
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        // 4. Renombrar columna temporal
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('estado_tmp', 'estado');
        });
    }

    public function down(): void
    {
        // Si haces rollback, volverá a enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('estado', ['activo','inactivo'])->default('activo');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
