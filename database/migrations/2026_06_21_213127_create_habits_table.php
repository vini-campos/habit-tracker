<?php

use App\Models\User;
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
        // nao precisa da coluna apos a tabela no foreignIdFor, por conta de ser o id
        // constrained e uma assinatura do laravel
        // cascadeOnDelete diz que e para ser deletado em cascata, nao afetando a foreignKey
        Schema::create('habits', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->string('name');
            $table->timestamps();
            
            $table->unique(['name', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habits');
    }
};
