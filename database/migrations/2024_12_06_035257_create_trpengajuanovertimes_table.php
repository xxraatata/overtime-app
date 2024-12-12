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
        Schema::create('dpo_trpengajuanovertime', function (Blueprint $table) {
            $table->id('pjn_id');
            $table->string('pjn_type');
            $table->string('pjn_description');
            $table->string('pjn_excel_proof');
            $table->string('pjn_pdf_proof');
            $table->string('pjn_review_notes');
            $table->string('pjn_status');
            $table->string('pjn_created_by');
            $table->string('pjn_modified_by');
            $table->unsignedBigInteger('pjn_kry_id');
            $table->timestamps();

            $table->index('pjn_kry_id');
        
            $table->foreign('pjn_kry_id')
                  ->references('kry_id')
                  ->on('dpo_mskaryawan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpo_trpengajuanovertime');
    }
};
