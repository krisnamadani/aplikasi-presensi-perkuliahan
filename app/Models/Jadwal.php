<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * jadwals
     *
     * @return void
     */

    protected $table = 'jadwals';
    protected $fillable = ['id', 'dosen_id', 'matakuliah_id', 'hari', 'jam_mulai', 'jam_selesai'];
    public $timestamps = true;

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function matakuliah()
    {
        return $this->hasOne(Matakuliah::class);
    }


}
