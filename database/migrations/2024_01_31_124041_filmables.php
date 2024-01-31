<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filmables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->morphs('filmable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filmables');
    }
};
