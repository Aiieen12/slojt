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
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ojt_profile_id')->nullable()->constrained()->onDelete('set null');

            $table->integer('day_no')->nullable();
            $table->date('log_date');
            $table->string('location')->nullable();
            $table->string('department_unit')->nullable();

            $table->text('daily_activity');
            $table->text('knowledge_skill')->nullable();
            $table->text('tools_technology')->nullable();
            $table->text('issue_challenge')->nullable();
            $table->text('reflection_solution')->nullable();

            $table->enum('status', ['draft', 'completed'])->default('completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
