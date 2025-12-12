<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained()->onDelete('cascade');
            $table->string('license_number')->unique();
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('status'); // active, expired, suspended
            $table->text('conditions')->nullable();
            $table->decimal('fee_amount', 10, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();
            
            $table->index('license_number');
            $table->index('expiry_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
