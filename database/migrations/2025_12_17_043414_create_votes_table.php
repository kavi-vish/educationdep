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
    Schema::create('votes', function (Blueprint $table) {
        $table->id();
        $table->string('vote_number')->unique(); // e.g., "1001"
        $table->string('description');
        $table->decimal('total_allocated', 15, 2)->default(0);
        $table->decimal('total_used', 15, 2)->default(0);
        $table->decimal('remaining', 15, 2)->default(0);
        $table->timestamps();
    });

    // Monthly allocations
    Schema::create('fund_allocations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vote_id')->constrained()->onDelete('cascade');
        $table->year('year');
        $table->tinyInteger('month'); // 1-12
        $table->decimal('amount', 15, 2);
        $table->text('remarks')->nullable();
        $table->timestamps();

        $table->unique(['vote_id', 'year', 'month']);
    });
}
};
