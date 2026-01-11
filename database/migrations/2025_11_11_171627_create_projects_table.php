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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id'); // Auto-incrementing primary key

            $table->text('strategy')->nullable();
            $table->string('activity_no', 50)->nullable();
            $table->text('activity_description')->nullable();
            $table->string('location', 255)->nullable(); // Added reasonable length

            // Physical targets (quarters)
            $table->decimal('q1', 12, 2)->nullable();
            $table->decimal('q2', 12, 2)->nullable();
            $table->decimal('q3', 12, 2)->nullable();
            $table->decimal('q4', 12, 2)->nullable();

            // Fixed: removed incorrect second parameter that caused auto_increment conflict
            $table->integer('budget_head')->nullable();
            $table->string('programme', 50)->nullable();
            $table->string('project', 50)->nullable();
            $table->integer('object_code')->nullable(); // Fixed here
            $table->integer('no_of_units')->nullable();

            $table->decimal('unit_cost', 12, 2)->nullable(); // Rs.'000

            // Estimated costs
            $table->decimal('estimated_cost_r', 12, 2)->nullable();
            $table->decimal('estimated_cost_c', 12, 2)->nullable();
            $table->decimal('estimated_cost_t', 12, 2)->nullable();

            $table->string('kpi', 255)->nullable(); // Key Performance Indicator
            $table->string('funding_source', 50)->nullable();
            $table->string('reference_plan', 100)->nullable();

            // Zone allocations (with default 0)
            $table->decimal('galle', 12, 2)->default(0);
            $table->decimal('ambalangoda', 12, 2)->default(0);
            $table->decimal('elipitiya', 12, 2)->default(0);
            $table->decimal('udugama', 12, 2)->default(0);
            $table->decimal('matara', 12, 2)->default(0);
            $table->decimal('akurassa', 12, 2)->default(0);
            $table->decimal('mulkirigala', 12, 2)->default(0);
            $table->decimal('deniyaya', 12, 2)->default(0);
            $table->decimal('hambantota', 12, 2)->default(0);
            $table->decimal('tangalle', 12, 2)->default(0);
            $table->decimal('walasmulla', 12, 2)->default(0);
            $table->decimal('pde', 12, 2)->default(0);

            $table->decimal('total', 12, 2)->default(0);

            // Status and timestamps
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};