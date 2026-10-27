<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE citas
            MODIFY COLUMN estado
            ENUM('pendiente', 'confirmada', 'cancelada', 'completada')
            NOT NULL DEFAULT 'pendiente'
        ");
    }

    public function down(): void
    {
        DB::statement("
            UPDATE citas
            SET estado = 'confirmada'
            WHERE estado = 'completada'
        ");

        DB::statement("
            ALTER TABLE citas
            MODIFY COLUMN estado
            ENUM('pendiente', 'confirmada', 'cancelada')
            NOT NULL DEFAULT 'pendiente'
        ");
    }
};
