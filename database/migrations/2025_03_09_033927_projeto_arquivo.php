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
        Schema::create('projeto_arquivo', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger("projeto_id");
            $table->foreign("projeto_id")->references("id")->on("projetos");
            $table->unsignedBigInteger("arquivo_id");
            $table->foreign("arquivo_id")->references("id")->on("arquivos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projeto_arquivo');
    }
};
