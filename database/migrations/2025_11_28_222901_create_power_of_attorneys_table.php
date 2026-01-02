<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('power_of_attorneys', function (Blueprint $table) {
            $table->id();

            $table->foreignId('matter_id')->nullable()->constrained()->onDelete('cascade'); // مرتبطة بقضية/معاملة
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // صاحب الوكالة
            $table->foreignId('authorized_user_id')->nullable()->constrained('users')->onDelete('set null'); // الوكيل (محامي / موظف)

            $table->string('poa_number', 100); // رقم الوكالة
            $table->string('issuer'); // الجهة المصدرة
            $table->date('issue_date'); // تاريخ الإصدار
            $table->date('expiry_date')->nullable(); // تاريخ الانتهاء
            $table->enum('type', ['general', 'specific']); // عامة / خاصة

            $table->text('permissions')->nullable(); // الصلاحيات
            $table->string('file_path')->nullable(); // ملف PDF

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('power_of_attorneys');
    }
};
