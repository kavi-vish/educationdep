<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estimated_budget_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('estimated_budget_id')->constrained()->onDelete('cascade');
    $table->string('category'); // e.g., Resource Allowance 1
    $table->decimal('rate', 12, 2)->nullable();
    $table->integer('quantity')->nullable();
    $table->integer('days_hours')->nullable();
    $table->decimal('amount', 15, 2)->default(0);
    $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimated_budget_items');
    }
};
