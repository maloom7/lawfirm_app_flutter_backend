<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->id();

            // العميل المرتبط بالقضية
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->cascadeOnDelete();

            // رقم مرجعي للمكتب
            $table->string('reference_number')->nullable()->unique();

            // نوع القضية/المعاملة
            $table->string('type'); // litigation, execution, contract, agency, complaint, etc.

            // موضوع القضية
            $table->string('title');

            // وصف مختصر
            $table->text('description')->nullable();

            // الحالة الإجرائية
            $table->string('status')->default('in_progress'); 
            // in_progress — completed — closed — paused — won — lost — settled

            // المرحلة القضائية
            $table->string('stage')->nullable(); 
            // first — appeal — supreme — enforcement — other

            // التاريخ المتوقع للقرار/الجلسة
            $table->date('next_session_date')->nullable();

            // المستخدم الذي أنشأ السجل
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matters');
    }
};
