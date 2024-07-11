<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jeniscuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
