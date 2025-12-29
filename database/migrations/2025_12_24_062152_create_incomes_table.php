<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_fk')->nullable();
            $table->decimal('amt', 10, 2)->default(0);
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('remarks');
            $table->date('time')->nullable();
            $table->integer('level')->default(0);
            $table->string('rname')->nullable();
            $table->string('fullname')->nullable();
            $table->unsignedBigInteger('invest_id')->nullable();
            $table->tinyInteger('credit_type')->default(0); // 0=credit,1=pending
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
