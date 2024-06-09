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
        Schema::create('reunioes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('pregador_id')->constrained('membros');
            $table->string('tema');
            $table->integer('duracao');
            $table->integer('presentes')->nullable();
            $table->integer('visitantes')->nullable();
            $table->timestamps();

            $table->boolean('ativo')->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reunioes');
    }
};
