<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternatif;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class VikorController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $alternatifs = Alternatif::all();
        $penilaians = Penilaian::with(['alternatif', 'criteria'])->get();

        // Create Decision Matrix (F)
        $sample = [];
        foreach ($alternatifs as $a) {
            foreach ($criterias as $c) {
                $value = $penilaians->where('id_alternatif', $a->id)
                                    ->where('id_kriteria', $c->id)
                                    ->first();
                $sample[$a->id][$c->id] = $value->nilai ?? 0;
            }
        }

        // Create Normalization Matrix (N)
        $f_plus = $f_min = [];
        foreach ($sample as $kriteria) {
            foreach ($kriteria as $j => $nilai) {
                if (!isset($f_plus[$j])) {
                    $f_plus[$j] = $f_min[$j] = $nilai;
                }
                $f_plus[$j] = max($f_plus[$j], $nilai);
                $f_min[$j] = min($f_min[$j], $nilai);
            }
        }

        $N = [];
        foreach ($sample as $i => $kriteria) {
            foreach ($kriteria as $j => $nilai) {
                $N[$i][$j] = ($f_plus[$j] - $nilai) / ($f_plus[$j] - $f_min[$j]);
            }
        }

        // Create Weighted Normalization Matrix (F*)
        $bobot = $criterias->pluck('weight', 'id')->toArray();
        $F_star = [];
        foreach ($N as $i => $kriteria) {
            foreach ($kriteria as $j => $nilai) {
                $F_star[$i][$j] = $nilai * ($bobot[$j] ?? 1);
            }
        }

        // Compute Utility Measures (S and R)
        $S = $R = [];
        foreach ($F_star as $i => $kriteria) {
            $S[$i] = array_sum($kriteria);
            $R[$i] = max($kriteria);
        }

        // Compute VIKOR Index (Q)
        $Q = [];
        $v = [0.41, 0.5, 0.59];
        foreach ($v as $val) {
            $Q[$val] = $this->get_Q($S, $R, $val);
        }

        // Rank Alternatives
        $sortedRanking = [];
        foreach ($v as $val) {
            asort($Q[$val]);
            $sortedRanking[$val] = array_keys($Q[$val]);
        }

        return view('vikor.index', [
            'criterias' => $criterias,
            'alternatifs' => $alternatifs,
            'penilaians' => $penilaians,
            'sample' => $sample,
            'N' => $N,
            'F_star' => $F_star,
            'S' => $S,
            'R' => $R,
            'Q' => $Q,
            'sortedRanking' => $sortedRanking,
       
        ]);
    }

    private function get_Q($S, $R, $v = 0.5)
    {
        $S_plus = max($S);
        $S_min = min($S);
        $R_plus = max($R);
        $R_min = min($R);

        $Q = [];
        foreach ($R as $i => $r) {
            $Q[$i] = $v * (($S[$i] - $S_min) / ($S_plus - $S_min))
                + (1 - $v) * (($r - $R_min) / ($R_plus - $R_min));
        }
        return $Q;
    }

    public function create()
    {
        // Page for creating new data if needed
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:criteria,id',
            'id_alternatif' => 'required|exists:alternatifs,id',
            'nilai' => 'required|numeric|min:0',
        ]);

        // Save Penilaian data
        Penilaian::create([
            'id_kriteria' => $request->id_kriteria,
            'id_alternatif' => $request->id_alternatif,
            'nilai' => $request->nilai,
        ]);

        // Redirect to data input page with success message
        return redirect()->route('inputdata.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function editPenilaian($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $criterias = Criteria::all(); 
        $alternatifs = Alternatif::all();

        return view('inputdata.edit', compact('penilaian', 'criterias', 'alternatifs'));
    }

    public function updatePenilaian(Request $request)
    {
        $penilaian = Penilaian::findOrFail($request->id_penilaian);
        $penilaian->nilai = $request->nilai;
        $penilaian->save();

        return redirect()->route('inputdata.index')->with('success', 'Penilaian updated successfully.');
    }
}