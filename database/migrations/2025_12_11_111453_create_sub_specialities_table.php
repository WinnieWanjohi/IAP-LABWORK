<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_specialities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('speciality_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->unique(['speciality_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_specialities');
    }
};
