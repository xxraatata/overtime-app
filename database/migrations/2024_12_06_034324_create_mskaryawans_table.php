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
        Schema::create('dpo_mskaryawan', function (Blueprint $table) {
            $table->id('kry_id');
            $table->string('kry_id_alternative');
            $table->string('kry_jabatan');
            $table->string('kry_name');
            $table->string('kry_username');
            $table->string('kry_password');
            $table->string('kry_email');
            $table->string('kry_status');
            $table->string('kry_created_by');
            $table->string('kry_modified_by');
            $table->timestamps();

            $table->index('kry_jabatan');
        
            $table->foreign('kry_jabatan')
                  ->references('jbt_id')
                  ->on('dpo_msjabatan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpo_mskaryawan');
    }
};
