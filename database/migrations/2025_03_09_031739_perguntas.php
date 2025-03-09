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
        Schema::create('perguntas', function (Blueprint $table) {
            $table->id();
            $table->text('titulo');                    
            $table->boolean('ativo')->default(true);
            $table->dateTime('data_cadastro')->default(now());          
            
            $table->unsignedBigInteger("tematica_id");
            $table->foreign("tematica_id")->references("id")->on("tematicas");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguntas');
    }
};
