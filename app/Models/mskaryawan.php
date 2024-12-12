<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mskaryawan extends Model
{
    use HasFactory;

    protected $primaryKey = 'kry_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kry_id_alternative',
        'kry_name',
        'kry_username',
        'kry_password',
        'kry_email',
        'kry_status',
        'kry_created_by',
        'kry_modified_by'
    ];

    public function trpengajuan() {
        return $this->hasMany(trpengajuanovertime::class, 'pjn_kry_id', 'kry_id');
    }

}
