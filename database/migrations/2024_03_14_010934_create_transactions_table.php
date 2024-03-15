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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->text('vendor');
            $table->decimal('spend', 8, 2)->default(0);
            $table->decimal('deposit', 8, 2)->default(0);
            $table->decimal('balance', 8, 2)->nullable();
            $table->text('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
