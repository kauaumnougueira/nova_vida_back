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
        Schema::create('celulas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedInteger('qtd_membros')->default(0);
            $table->unsignedInteger('qtd_membros_inicio')->default(0);
            $table->date('data_inicio');
            $table->integer('ordem_multiplicacao')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->boolean('ativo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celula');
    }
};
