<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained()->onDelete('cascade');
            $table->string('type'); // email, phone, address, etc.
            $table->string('value');
            $table->boolean('is_primary')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['practitioner_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
