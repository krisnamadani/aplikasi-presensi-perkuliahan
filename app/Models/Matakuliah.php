<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    /**
     * matakuliahs
     *
     * @return void
     */

    protected $table = 'matakuliahs';
    protected $fillable = ['id', 'kode_matakuliah', 'nama', 'sks', 'jenis'];
    public $timestamps = true;

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
