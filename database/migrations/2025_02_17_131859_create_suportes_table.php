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
        Schema::create('suportes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente',500);
            $table->string('telefone_cliente',50);
            $table->string('email_cliente',500);
            $table->string('tipo_duvida',255);
            $table->text('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suportes');
    }
};
