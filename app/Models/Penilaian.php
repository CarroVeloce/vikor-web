<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alternatif', 
        'id_kriteria', 
        'nilai'
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_kriteria');
    }

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }
}
