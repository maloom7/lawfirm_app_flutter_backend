<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matters', function (Blueprint $table) {
            $table->string('case_number')->nullable()->unique(); // رقم القضية
            $table->year('case_year')->nullable();              // السنة (اختيارية)
        });
    }

    public function down(): void
    {
        Schema::table('matters', function (Blueprint $table) {
            $table->dropColumn(['case_number', 'case_year']);
        });
    }
};
