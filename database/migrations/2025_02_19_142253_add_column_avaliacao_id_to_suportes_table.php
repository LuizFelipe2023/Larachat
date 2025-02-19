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
        Schema::table('suportes', function (Blueprint $table) {
               $table->unsignedBigInteger('avaliacao_id')->nullable();
               $table->foreign('avaliacao_id')->references('id')->on('avaliacoes')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suportes', function (Blueprint $table) {
               $table->dropForeign(['avaliacao_id']);
               $table->dropColumn('avaliacao_id');
        });
    }
};
