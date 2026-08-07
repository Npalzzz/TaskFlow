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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->foreignId('category_id')->constrained()->cascadeOnDelete();

        $table->string('judul');

        $table->text('deskripsi')->nullable();

        $table->date('deadline');

        $table->enum('priority', [
            'Rendah',
            'Sedang',
            'Tinggi'
        ])->default('Sedang');

        $table->enum('status', [
            'Belum',
            'Proses',
            'Selesai'
        ])->default('Belum');

        $table->boolean('reminder_enabled')->default(true);

        $table->integer('reminder_days')->default(1);

        $table->timestamps();
    });
}
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};