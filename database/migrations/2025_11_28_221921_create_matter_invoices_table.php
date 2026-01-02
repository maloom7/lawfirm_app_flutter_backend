<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matter_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')->constrained()->onDelete('cascade'); // القضية
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // الموظف/المحامي الذي أصدر الفاتورة
            $table->string('invoice_number')->unique(); // رقم الفاتورة
            $table->decimal('amount', 12, 2); // قيمة الفاتورة
            $table->decimal('paid', 12, 2)->default(0); // المبلغ المدفوع
            $table->date('due_date')->nullable(); // تاريخ الاستحقاق
            $table->date('payment_date')->nullable(); // تاريخ السداد
            $table->enum('status', ['unpaid', 'paid', 'overdue', 'in_progress'])->default('unpaid'); // حالة الفاتورة
            $table->text('description')->nullable(); // ملاحظات
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matter_invoices');
    }
};
