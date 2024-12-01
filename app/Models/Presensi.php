<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    /**
     * presensis
     *
     * @return void
     */

    protected $table = 'presensis';
    protected $fillable = ['id', 'jadwal_id', 'dosen_id', 'waktu_presensi'];
    public $timestamps = true;

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }
}
