<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    /**
     * dosens
     *
     * @return void
     */


    protected $table = 'dosens';
    protected $fillable = ['id', 'nama', 'email', 'password'];
    public $timestamps = true;

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
