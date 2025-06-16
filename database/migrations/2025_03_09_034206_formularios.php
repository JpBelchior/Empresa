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
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->dateTime('data_cadastro')->default(now());

            $table->integer('total_perguntas')->default(0);
            $table->integer('total_perguntas_respondidas')->default(0);
            $table->double('porcentagem_preenchimento')->default(0);
            $table->integer('total_vulnerabilidades')->default(0);
            $table->integer('total_riscos_altissimos')->default(0);
            $table->integer('total_recomendacoes')->default(0);
                        
            $table->unsignedBigInteger("empresa_id");
            $table->foreign("empresa_id")->references("id")->on("empresas");
            $table->unsignedBigInteger("projeto_id");
            $table->foreign("projeto_id")->references("id")->on("projetos");
            $table->unsignedBigInteger("criado_por_usuario_id");
            $table->foreign("criado_por_usuario_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios');
    }
};
