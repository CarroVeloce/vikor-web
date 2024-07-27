@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-800 mb-8">Input Data</h1>

<!-- Form untuk menambah kriteria -->
<div class="mb-8 p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Kriteria</h2>
    <form action="{{ route('inputdata.createCriteria') }}" method="POST" class="space-y-6">
        @csrf
        <div class="form-group">
            <label for="kode_kriteria" class="block text-gray-600 text-sm font-medium mb-2">Kode Kriteria</label>
            <input id="kode_kriteria" type="text" name="kode_kriteria" placeholder="Kode Kriteria" required
                class="form-input">
        </div>
        <div class="form-group">
            <label for="nama_kriteria" class="block text-gray-600 text-sm font-medium mb-2">Nama Kriteria</label>
            <input id="nama_kriteria" type="text" name="nama_kriteria" placeholder="Nama Kriteria" required
                class="form-input">
        </div>
        <div class="form-group">
            <label for="criteria_type" class="block text-gray-600 text-sm font-medium mb-2">Type</label>
            <select id="criteria_type" name="criteria_type" required
                class="form-select">
                <option value="Cost">Cost</option>
                <option value="Benefit">Benefit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="weight" class="block text-gray-600 text-sm font-medium mb-2">Weight</label>
            <input id="weight" type="number" step="0.01" name="weight" placeholder="Weight" class="form-input">
        </div>
        <button type="submit" class="btn-submit">Add Criteria</button>
    </form>
</div>

<!-- Form untuk menambah alternatif -->
<div class="mb-8 p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Alternatif</h2>
    <form action="{{ route('inputdata.createAlternatif') }}" method="POST" class="space-y-6">
        @csrf
        <div class="form-group">
            <label for="alternatif_code" class="block text-gray-600 text-sm font-medium mb-2">Alternatif Code</label>
            <input id="alternatif_code" type="text" name="alternatif_code" placeholder="Alternatif Code" required
                class="form-input">
        </div>
        <div class="form-group">
            <label for="alternatif_name" class="block text-gray-600 text-sm font-medium mb-2">Alternatif Name</label>
            <input id="alternatif_name" type="text" name="alternatif_name" placeholder="Alternatif Name" required
                class="form-input">
        </div>
        <button type="submit" class="btn-submit">Add Alternatif</button>
    </form>
</div>

<!-- Form untuk menyimpan penilaian dalam bentuk tabel -->
<div class="mb-8 p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Penilaian</h2>
    <form action="{{ route('inputdata.store') }}" method="POST" class="space-y-6">
        @csrf
        <table class="table-auto w-full border border-gray-300 rounded-md bg-gray-50">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 text-left text-gray-600">Alternatif</th>
                    @foreach($criterias as $criteria)
                        <th class="p-4 text-left text-gray-600">{{ $criteria->nama_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $alternatif)
                    <tr class="border-t border-gray-300">
                        <td class="p-4">{{ $alternatif->alternatif_name }}</td>
                        @foreach($criterias as $criteria)
                            @php
                                $penilaian = $penilaians->firstWhere(function ($p) use ($alternatif, $criteria) {
                                    return $p->id_alternatif == $alternatif->id && $p->id_criteria == $criteria->id;
                                });
                            @endphp
                            <td class="p-4">
                                <input type="number" step="0.01" name="penilaians[{{ $alternatif->id }}][{{ $criteria->id }}]"
                                    placeholder="Nilai" value="{{ $penilaian ? $penilaian->nilai : '' }}"
                                    class="form-input" required>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn-submit mt-4">Add Penilaian</button>
    </form>
</div>

<!-- Tabel Kriteria -->
<div class="mb-8 p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Kriteria</h2>
    <table class="table-auto w-full border border-gray-300 rounded-md bg-gray-50">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-4 text-left text-gray-600">Kode</th>
                <th class="p-4 text-left text-gray-600">Nama</th>
                <th class="p-4 text-left text-gray-600">Type</th>
                <th class="p-4 text-left text-gray-600">Weight</th>
                <th class="p-4 text-left text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($criterias as $criteria)
                <tr class="border-t border-gray-300">
                    <td class="p-4">{{ $criteria->kode_kriteria }}</td>
                    <td class="p-4">{{ $criteria->nama_kriteria }}</td>
                    <td class="p-4">{{ $criteria->criteria_type }}</td>
                    <td class="p-4">{{ $criteria->weight }}</td>
                    <td class="p-4">
                        <form action="{{ route('inputdata.deleteCriteria') }}" method="POST">
                            @csrf
                            @method('DELETE') <!-- Simulates DELETE method -->
                            <input type="hidden" name="id_kriteria" value="{{ $criteria->id }}">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tabel Alternatif -->
<div class="mb-8 p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Alternatif</h2>
    <table class="table-auto w-full border border-gray-300 rounded-md bg-gray-50">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-4 text-left text-gray-600">Code</th>
                <th class="p-4 text-left text-gray-600">Name</th>
                <th class="p-4 text-left text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $alternatif)
                <tr class="border-t border-gray-300">
                    <td class="p-4">{{ $alternatif->alternatif_code }}</td>
                    <td class="p-4">{{ $alternatif->alternatif_name }}</td>
                    <td class="p-4">
                        <form action="{{ route('inputdata.deleteAlternatif') }}" method="POST">
                            @csrf
                            @method('DELETE') <!-- Simulates DELETE method -->
                            <input type="hidden" name="id_alternatif" value="{{ $alternatif->id }}">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tabel Penilaian -->
<div class="mb-8 p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Penilaian</h2>
    <table class="table-auto w-full border border-gray-300 rounded-md bg-gray-50">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-4 text-left text-gray-600">Kriteria</th>
                <th class="p-4 text-left text-gray-600">Alternatif</th>
                <th class="p-4 text-left text-gray-600">Nilai</th>
                <th class="p-4 text-left text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaians as $penilaian)
                <tr class="border-t border-gray-300">
                    <td class="p-4">{{ $penilaian->criteria->nama_kriteria }}</td>
                    <td class="p-4">{{ $penilaian->alternatif->alternatif_name }}</td>
                    <td class="p-4">{{ $penilaian->nilai }}</td>
                    <td class="p-4">
                        <!-- Edit Button -->
                        <a href="{{ route('inputdata.editPenilaian', $penilaian->id) }}"
                           class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600">
                           Edit
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('inputdata.deletePenilaian') }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE') <!-- Simulates DELETE method -->
                            <input type="hidden" name="id_penilaian" value="{{ $penilaian->id }}">
                            <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md shadow-sm hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
