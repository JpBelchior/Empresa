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
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->text("resposta");            

            $table->string('nivel_adequacao', '2');
            $table->string('nivel_probabilidade', '2');
            $table->string('nivel_impacto', '2');
            $table->string('nivel_esforco', '2');
            $table->string('nivel_valor', '2');
            $table->boolean('esta_em_vulnerabilidade');
            $table->string('vulnerabilidade_vigente', '2');
            $table->boolean('esta_em_risco_altissimo');
            $table->string('risco_altissimo_vigente', '2');
            $table->string('prazo', '30');

            $table->unsignedBigInteger("arquivo_id");
            $table->foreign("arquivo_id")->references("id")->on("arquivos");
            $table->dateTime('data_cadastro')->default(now());
            $table->unsignedBigInteger("pergunta_id");
            $table->foreign("pergunta_id")->references("id")->on("perguntas");
            $table->unsignedBigInteger("formulario_id");
            $table->foreign("formulario_id")->references("id")->on("formularios");            
            $table->unsignedBigInteger("respondido_por_usuario_id");
            $table->foreign("respondido_por_usuario_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};
