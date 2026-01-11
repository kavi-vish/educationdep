<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actual_budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actual_budget_id')->constrained('actual_budgets')->cascadeOnDelete();
            $table->string('category');

            // Estimated (read-only)
            $table->decimal('est_rate', 12,2)->default(0);
            $table->integer('est_quantity')->default(0);
            $table->integer('est_days_hours')->default(0);
            $table->decimal('est_amount', 15,2)->default(0);

            // Actual (user fills)
            $table->decimal('actual_rate', 12,2)->default(0);
            $table->integer('actual_quantity')->default(0);
            $table->integer('actual_days_hours')->default(0);
            $table->decimal('actual_amount', 15,2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actual_budget_items');
    }
};