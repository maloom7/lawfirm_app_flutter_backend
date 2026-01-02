<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matter_parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')->constrained()->onDelete('cascade'); // رقم القضية
            $table->enum('party_type', [
                'plaintiff',            // مدعي
                'defendant',            // مدعى عليه
                'execution_applicant',  // طالب التنفيذ
                'execution_target',     // المنفذ ضده
                'intervenor',           // متدخل
                'representative',       // وكيل
                'other',                // آخر
            ]);
            $table->string('name'); // اسم الطرف
            $table->string('phone')->nullable(); // رقم التواصل
            $table->string('national_id')->nullable(); // رقم الهوية/السجل التجاري
            $table->string('address')->nullable(); // العنوان
            $table->text('notes')->nullable(); // ملاحظات
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matter_parties');
    }
};
