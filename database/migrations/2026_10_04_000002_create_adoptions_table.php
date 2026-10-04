<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\AdoptionStatus;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cat_id')->constrained()->cascadeOnDelete();
            $table->text('adoption_reason');
            $table->string('status')->default(AdoptionStatus::PENDING->value);
            $table->string('order_code')->nullable()->unique();
            $table->dateTime('pickup_datetime')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
