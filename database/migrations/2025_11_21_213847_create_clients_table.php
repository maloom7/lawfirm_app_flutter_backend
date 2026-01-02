<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            // نوع العميل: فرد / شركة / جهة حكومية
            $table->string('type')->default('individual'); // individual, company, government

            // البيانات الأساسية
            $table->string('name');              // اسم العميل
            $table->string('national_id')->nullable(); // رقم الهوية
            $table->string('cr_number')->nullable();   // السجل التجاري إن وجد

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            $table->text('notes')->nullable();

            // المستخدم الذي أنشأ العميل (اختياري الآن)
            $table->foreignId('created_by')->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
