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
        Schema::table('feedbacks', function (Blueprint $table) {
              $table->unsignedBigInteger('situacao_fk')->nullable();
              $table->foreign('situacao_fk')->references('id')->on('situacoes_feedback')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
              $table->dropForeign(['situacao_fk']);
              $table->dropColumn('situacao_fk');
        });
    }
};
