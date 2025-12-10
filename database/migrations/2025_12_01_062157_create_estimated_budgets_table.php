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
    Schema::create('estimated_budgets', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // no foreignId(), no constrained()
    $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    $table->string('zone'); // Galle, Matara, etc.
    $table->string('subject');
    $table->string('activity_code');
    $table->text('activity_description');
    $table->string('programme')->nullable();
    $table->string('vote')->nullable();
    $table->string('venue')->nullable();
    $table->date('date')->nullable();
    $table->string('funding_source')->nullable();
    $table->string('estimate_authorization_circular')->nullable();
    $table->date('date_submitted_for_settlement')->nullable();
    $table->string('reference_file_no')->nullable();
    $table->text('invited_participants')->nullable();
    $table->date('advance_date')->nullable();
    $table->decimal('estimated_total', 15, 2)->default(0);
    $table->decimal('advance_amount', 15, 2)->nullable();
    $table->decimal('total_expenditure', 15, 2)->default(0);
    $table->decimal('balance', 15, 2)->default(0);
    $table->decimal('deficit_amount', 15, 2)->default(0);
    $table->string('prepared_by'); // or use user name
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimated_budgets');
    }
};
