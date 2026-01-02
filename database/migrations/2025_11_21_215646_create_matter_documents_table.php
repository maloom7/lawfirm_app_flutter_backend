<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matter_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type')->nullable();
            $table->string('title');
            $table->string('file_path');
            $table->string('extension')->nullable();
            $table->date('upload_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matter_documents');
    }
};
