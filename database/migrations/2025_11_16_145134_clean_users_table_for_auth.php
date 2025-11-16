<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Eliminar columnas si existen
        if (Schema::hasColumn('users', 'telefono') ||
            Schema::hasColumn('users', 'especialidad') ||
            Schema::hasColumn('users', 'turno')) {

            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'telefono')) {
                    $table->dropColumn('telefono');
                }
                if (Schema::hasColumn('users', 'especialidad')) {
                    $table->dropColumn('especialidad');
                }
                if (Schema::hasColumn('users', 'turno')) {
                    $table->dropColumn('turno');
                }
            });
        }

        // 2. Renombrar estado → estado_login
        if (Schema::hasColumn('users', 'estado')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('estado', 'estado_login');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefono')->nullable();
            $table->string('especialidad')->nullable();
            $table->string('turno')->nullable();
        });

        if (Schema::hasColumn('users', 'estado_login')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('estado_login', 'estado');
            });
        }
    }
};
