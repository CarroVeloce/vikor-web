<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternatif;
use App\Models\Penilaian;

class InputDataController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $alternatifs = Alternatif::all();
        $penilaians = Penilaian::with(['criteria', 'alternatif'])->get(); // Mengambil data penilaian dengan relasi
        return view('inputdata.index', compact('criterias', 'alternatifs', 'penilaians'));
    }

    public function createCriteria(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:255',
            'nama_kriteria' => 'required|string|max:255',
            'criteria_type' => 'required|string|in:Cost,Benefit',
            'weight' => 'required|numeric|min:0',
        ]);

        Criteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'criteria_type' => $request->criteria_type,
            'weight' => $request->weight,
        ]);

        return redirect()->route('inputdata.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function deleteCriteria(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:criterias,id',
        ]);

        Criteria::destroy($request->id_kriteria);

        return redirect()->route('inputdata.index')->with('success', 'Kriteria berhasil dihapus.');
    }

    public function createAlternatif(Request $request)
    {
        $request->validate([
            'alternatif_code' => 'required|string|max:255',
            'alternatif_name' => 'required|string|max:255',
        ]);

        Alternatif::create([
            'alternatif_code' => $request->alternatif_code,
            'alternatif_name' => $request->alternatif_name,
        ]);

        return redirect()->route('inputdata.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function deleteAlternatif(Request $request)
    {
        $request->validate([
            'id_alternatif' => 'required|exists:alternatifs,id',
        ]);

        Alternatif::destroy($request->id_alternatif);

        return redirect()->route('inputdata.index')->with('success', 'Alternatif berhasil dihapus.');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'penilaians' => 'required|array',
            'penilaians.*.*' => 'nullable|numeric|min:0',
        ]);

        // Hapus semua data penilaian lama
        Penilaian::truncate();

        // Simpan data penilaian yang baru
        foreach ($request->penilaians as $alternatif_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $kriteria_id => $nilai) {
                Penilaian::create([
                    'id_kriteria' => $kriteria_id,
                    'id_alternatif' => $alternatif_id,
                    'nilai' => $nilai,
                ]);
            }
        }

        return redirect()->route('inputdata.index')->with('success', 'Penilaian berhasil disimpan. Anda sekarang bisa melanjutkan ke perhitungan VIKOR.');
    }

    public function deletePenilaian(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required|exists:penilaians,id',
        ]);

        Penilaian::destroy($request->id_penilaian);

        return redirect()->route('inputdata.index')->with('success', 'Penilaian berhasil dihapus.');
    }

    public function editPenilaian($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $criterias = Criteria::all(); // Assuming you need these for the form
        $alternatifs = Alternatif::all(); // Assuming you need these for the form

        return view('inputdata.edit', compact('penilaian', 'criterias', 'alternatifs'));
    }

    public function updatePenilaian(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required|exists:penilaians,id',
            'id_kriteria' => 'required|exists:criterias,id',
            'id_alternatif' => 'required|exists:alternatifs,id',
            'nilai' => 'required|numeric|min:0',
        ]);

        $penilaian = Penilaian::findOrFail($request->id_penilaian);
        $penilaian->id_kriteria = $request->id_kriteria;
        $penilaian->id_alternatif = $request->id_alternatif;
        $penilaian->nilai = $request->nilai;
        $penilaian->save();

        return redirect()->route('inputdata.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function showVikor()
    {
        $penilaians = Penilaian::all();

        // Cek apakah ada penilaian yang belum diisi
        if ($penilaians->isEmpty()) {
            return redirect()->route('inputdata.index')->with('error', 'Anda harus mengisi penilaian terlebih dahulu.');
        }

        // Jika penilaian sudah diisi, lanjutkan ke perhitungan VIKOR
        return view('vikor.index');
    }

    public function updateCriteria(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:kriteria,id',
            'kode_kriteria' => 'required|string|max:255',
            'nama_kriteria' => 'required|string|max:255',
            'criteria_type' => 'required|in:Cost,Benefit',
            'weight' => 'nullable|numeric|min:0',
        ]);

        $kriteria = Criteria::findOrFail($request->id_kriteria);
        $kriteria->update($request->only('kode_kriteria', 'nama_kriteria', 'criteria_type', 'weight'));

        return redirect()->route('inputdata.index')->with('success', 'Kriteria updated successfully!');
    }

    public function updateAlternatif(Request $request)
    {
        $request->validate([
            'id_alternatif' => 'required|exists:alternatifs,id',
            'alternatif_code' => 'required|string|max:255',
            'alternatif_name' => 'required|string|max:255',
        ]);

        $alternatif = Alternatif::findOrFail($request->id_alternatif);
        $alternatif->update($request->only('alternatif_code', 'alternatif_name'));

        return redirect()->route('inputdata.index')->with('success', 'Alternatif updated successfully!');
    }


}
