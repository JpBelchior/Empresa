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
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();            
            $table->string("nome");
            $table->date('data_projeto');            
            $table->unsignedBigInteger("empresa_id");
            $table->dateTime('data_cadastro')->default(now());
            $table->foreign("empresa_id")->references("id")->on("empresas");            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
