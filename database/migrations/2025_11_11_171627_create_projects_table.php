<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');

            $table->string('strategy')->nullable();
            $table->string('activity_no', 50)->nullable();
            $table->text('activity_description')->nullable();
            $table->string('location')->nullable();

            // Physical targets
            $table->string('q1')->nullable();
            $table->string('q2')->nullable();
            $table->string('q3')->nullable();
            $table->string('q4')->nullable();

            $table->string('budget_head', 50)->nullable();
            $table->string('programme', 50)->nullable();
            $table->string('project', 50)->nullable();
            $table->string('object_code', 50)->nullable();
            $table->integer('no_of_units')->nullable();
            $table->decimal('unit_cost', 12, 2)->nullable(); // Rs.'000

            // Estimated costs
            $table->decimal('estimated_cost_r', 12, 2)->nullable();
            $table->decimal('estimated_cost_c', 12, 2)->nullable();
            $table->decimal('estimated_cost_t', 12, 2)->nullable();

            $table->string('kpi', 255)->nullable(); // Key Performance Indicator
            $table->string('funding_source', 50)->nullable();
            $table->string('reference_plan', 100)->nullable(); // Reference to SDG/Proc ument plan

            // Zone allocations
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

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};