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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->unique();
            $table->string('nickname');
            $table->double('balance');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_type');

            $table->foreign('user_id')->references("id")->on('users');
            $table->foreign('account_type')->references("id")->on('account_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
