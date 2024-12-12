<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trpengajuanovertime extends Model
{
    use HasFactory;

    protected $fillable = [
        'pjn_type',
        'pjn_description',
        'pjn_excel_proof',
        'pjn_pdf_proof',
        'pjn_review_notes',
        'pjn_status',
        'pjn_created_by',
        'pjn_modified_by',
        'pjn_kry_id'
    ];

    public function mskaryawan() {
        return $this->belongsTo(mskaryawan::class, 'pjn_kry_id', 'kry_id');
    }

    public function msnotifikasi()
    {
        return $this->hasMany(msnotifikasi::class, 'pjn_id');
    }

}
