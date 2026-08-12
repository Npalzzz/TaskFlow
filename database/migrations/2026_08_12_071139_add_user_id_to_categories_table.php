<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | user_id sudah ada
        |--------------------------------------------------------------------------
        |
        | Percobaan migration sebelumnya sudah berhasil membuat kolom
        | user_id, tetapi gagal ketika membuat foreign key.
        |
        | Jadi kita TIDAK membuat kolom user_id lagi.
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Berikan kategori lama kepada user ID 2
        |--------------------------------------------------------------------------
        */

        DB::table('categories')
            ->whereNull('user_id')
            ->update([
                'user_id' => 2,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan user_id tidak boleh NULL
        |--------------------------------------------------------------------------
        */

        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                ->nullable(false)
                ->change();
        });


        /*
        |--------------------------------------------------------------------------
        | Tambahkan foreign key
        |--------------------------------------------------------------------------
        */

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};