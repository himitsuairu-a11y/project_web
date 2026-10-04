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
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->nullable();
            $table->string('job')->nullable();
            $table->decimal('salary', 12, 2)->nullable();
            $table->string('id_card_path')->nullable();
            $table->string('salary_slip_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'job',
                'salary',
                'id_card_path',
                'salary_slip_path'
            ]);
        });
    }
};
