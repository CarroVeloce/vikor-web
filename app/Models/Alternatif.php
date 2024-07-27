<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternatif_code', 
        'alternatif_name'
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_alternatif');
    }
}
