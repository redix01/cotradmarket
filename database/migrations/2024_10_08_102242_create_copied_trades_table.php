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
        Schema::create('copied_trades', function (Blueprint $table) {
            $table->id();
            $table->double('amount', 11, 2)->default(0);
            $table->double('profit_loss', 11, 2)->default(0);
            $table->string('status')->default('pending');
            $table->foreignUuid('user_id');
            $table->foreignUuid('copy_trader_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copied_trades');
    }
};
