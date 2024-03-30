<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengajuancuti()
    {
        return $this->hasMany(PengajuanCuti::class);
    }
}
