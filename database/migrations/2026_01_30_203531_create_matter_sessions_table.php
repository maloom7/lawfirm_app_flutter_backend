<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matter_sessions', function (Blueprint $table) {
            $table->id();

            // ربط بالقضية
            $table->foreignId('matter_id')
                ->constrained()
                ->cascadeOnDelete();

            // تاريخ ووقت الجلسة
            $table->date('session_date');
            $table->time('session_time')->nullable();

            // المحكمة والدائرة
            $table->string('court')->nullable();
            $table->string('circuit')->nullable();

            // حالة الجلسة
            $table->enum('status', [
                'scheduled',
                'held',
                'postponed',
                'cancelled'
            ])->default('scheduled');

            // قرار الجلسة
            $table->text('decision')->nullable();

            // ملاحظات
            $table->text('notes')->nullable();

            // المحامي/الموظف الحاضر
            $table->foreignId('attended_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matter_sessions');
    }
};
