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
        Schema::create('recuperacao_senha', function (Blueprint $table) {
            $table->id();
            $table->string("token");
            $table->dateTime('data_cadastro')->default(now());
            $table->dateTime('data_expiracao');
            $table->boolean('usado')->default(false);
            $table->unsignedBigInteger("usuario_id");
            $table->foreign("usuario_id")->references("id")->on("users");
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recuperacao_senha');
    }
};
