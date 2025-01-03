<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mskaryawan extends Authenticatable
{
    use HasFactory;

    protected $table = 'dpo_mskaryawan';
    protected $primaryKey = 'kry_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kry_id_alternative',
        'kry_jabatan',
        'kry_name',
        'kry_username',
        'kry_password',
        'kry_email',
        'kry_status',
        'kry_created_by',
        'kry_modified_by'
    ];

    public function getAuthPassword()
    {
        return $this->kry_password;
    }
}
