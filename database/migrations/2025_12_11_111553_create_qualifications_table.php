<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained()->onDelete('cascade');
            $table->foreignId('degree_id')->constrained()->onDelete('cascade');
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->integer('year_awarded')->nullable();
            $table->string('certificate_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['practitioner_id', 'degree_id', 'institution_id', 'year_awarded'], 'qualification_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qualifications');
    }
};
