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
            
            $table->unsignedBigInteger("tipo_empreendimento_id");
            $table->foreign("tipo_empreendimento_id")->references("id")->on("tipos_empreendimentos");
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
