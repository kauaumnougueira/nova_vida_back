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
        Schema::create('membro_cargo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('celula_id');
            $table->boolean('ativo')->default(true);
            $table->date('data_associacao');

            // Chave estrangeira para membro
            $table->foreign('membro_id')->references('id')->on('membros')->onDelete('cascade');

            // Chave estrangeira para cargo
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');

            // Chave estrangeira para cargo
            $table->foreign('celula_id')->references('id')->on('celulas')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membro_cargo');
    }
};
