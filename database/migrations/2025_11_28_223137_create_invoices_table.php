<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->morphs('billable'); // billable_id + billable_type (قضية - عقد - معاملة ...)
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // صاحب الفاتورة
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // من أصدر الفاتورة

            $table->string('invoice_number')->unique();
            $table->decimal('amount', 12, 2);
            $table->decimal('paid', 12, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();

            $table->enum('status', ['unpaid', 'paid', 'overdue', 'in_progress'])->default('unpaid');
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
