<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actual_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimated_budget_id')->constrained('estimated_budgets')->cascadeOnDelete();

            
            $table->unsignedBigInteger('user_id');

            $table->decimal('actual_total', 15,2)->default(0);
            $table->decimal('balance', 15,2)->default(0);
            $table->decimal('deficit_amount', 15,2)->default(0);
            $table->string('prepared_by');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->unique('estimated_budget_id'); // one actual per estimate
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actual_budgets');
    }
};