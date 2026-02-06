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

    $table->foreignId('matter_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('session_date');

    $table->string('court')->nullable();
    $table->string('circuit')->nullable();

    $table->enum('session_type', ['in_person', 'remote'])
        ->default('in_person');

    // المحامي أو الموظف المسؤول عن الحضور
    $table->foreignId('assigned_lawyer_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    // نتيجة الجلسة
    $table->text('result')->nullable();

    // الإجراء القادم (جلسة قادمة، مذكرة، حكم...)
    $table->text('next_action')->nullable();

    $table->text('notes')->nullable();

    $table->timestamps();
});

    }

    // public function down(): void
    // {
    //     Schema::dropIfExists('matter_sessions');
    // }
};
