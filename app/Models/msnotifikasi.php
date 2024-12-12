<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class msnotifikasi extends Model
{
    use HasFactory;

    protected $table = 'dpo_msnotifikasi';

    protected $primaryKey = 'ntf_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'ntf_message',
        'ntf_status',
        'ntf_created_by',
        'ntf_modified_by',
        'ntf_pjn_id'
    ];

    public function trpengajuan() {
        return $this->belongsTo(trpengajuanovertime::class, 'ntf_pjn_id', 'pjn_id');
    }
}
