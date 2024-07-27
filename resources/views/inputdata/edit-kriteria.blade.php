@extends('layouts.app')

@section('content')
    <h2>Edit Kriteria</h2>
    <form action="{{ route('inputdata.updateCriteria') }}" method="POST">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->
        <input type="hidden" name="id_kriteria" value="{{ $kriteria->id }}">
        
        <div>
            <label for="kode_kriteria">Kode Kriteria</label>
            <input type="text" name="kode_kriteria" id="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" required>
        </div>
        <div>
            <label for="nama_kriteria">Nama Kriteria</label>
            <input type="text" name="nama_kriteria" id="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required>
        </div>
        <div>
            <label for="criteria_type">Type</label>
            <select name="criteria_type" id="criteria_type" required>
                <option value="Cost" {{ $kriteria->criteria_type == 'Cost' ? 'selected' : '' }}>Cost</option>
                <option value="Benefit" {{ $kriteria->criteria_type == 'Benefit' ? 'selected' : '' }}>Benefit</option>
            </select>
        </div>
        <div>
            <label for="weight">Weight</label>
            <input type="number" step="0.01" name="weight" id="weight" value="{{ $kriteria->weight }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
