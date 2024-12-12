<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class msjabatan extends Model
{
    use HasFactory;

    protected $table = 'dpo_msjabatan';

    protected $primaryKey = 'jbt_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jbt_name',
        'jbt_status'
    ];

    public function getJabatanId() {
        return $this->hasMany(mskaryawan::class, 'kry_jabatan', 'jbt_id');
    }
}
