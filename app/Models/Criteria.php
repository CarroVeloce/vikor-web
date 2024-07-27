<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kriteria', 
        'nama_kriteria', 
        'criteria_type', 
        'weight'
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_kriteria');
    }
}
