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
        Schema::table('adoptions', function (Blueprint $table) {
            if (!Schema::hasColumn('adoptions', 'applicant_name')) {
                $table->string('applicant_name')->nullable();
            }

            if (!Schema::hasColumn('adoptions', 'applicant_address')) {
                $table->string('applicant_address')->nullable();
            }

            if (!Schema::hasColumn('adoptions', 'salary_slip_path')) {
                $table->string('salary_slip_path')->nullable();
            }

            if (!Schema::hasColumn('adoptions', 'identity_card_path')) {
                $table->string('identity_card_path')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $columns = [
                'applicant_name',
                'applicant_address',
                'salary_slip_path',
                'identity_card_path'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('adoptions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};