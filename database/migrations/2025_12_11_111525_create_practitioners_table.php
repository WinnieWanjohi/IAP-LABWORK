<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioners', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('fullname');
            $table->foreignId('status_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('speciality_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sub_speciality_id')->nullable()->constrained('sub_specialities')->nullOnDelete();
            $table->string('discipline')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_link')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('raw_data')->nullable(); // Store original scraped data
            $table->timestamps();
            
            $table->index('registration_number');
            $table->index('fullname');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioners');
    }
};
