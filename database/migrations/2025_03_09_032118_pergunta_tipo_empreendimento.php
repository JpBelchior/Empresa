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
        Schema::create('pergunta_tipo_empreendimento', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger("pergunta_id");
            $table->foreign("pergunta_id")->references("id")->on("perguntas");
            $table->unsignedBigInteger("tipo_empreendimento_id");
            $table->foreign("tipo_empreendimento_id")->references("id")->on("tipos_empreendimentos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pergunta_tipo_empreendimento');
    }
};
