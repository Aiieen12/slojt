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
        Schema::table('daily_logs', function (Blueprint $table) {
            $table->string('issue_challenge_type')->default('issue')->after('tools_technology');
            $table->string('issue_challenge_image_path')->nullable()->after('issue_challenge');
            $table->text('flowchart_steps')->nullable()->after('issue_challenge_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_logs', function (Blueprint $table) {
            $table->dropColumn([
                'issue_challenge_type',
                'issue_challenge_image_path',
                'flowchart_steps',
            ]);
        });
    }
};
