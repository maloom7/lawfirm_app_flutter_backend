<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->id();

            // الاسم الأساسي
            $table->string('name');

            // نوع الخصم
            $table->string('type')->default('individual'); 
            // individual, company, government, lawyer

            // معلومات إضافية
            $table->string('national_id')->nullable();
            $table->string('cr_number')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
