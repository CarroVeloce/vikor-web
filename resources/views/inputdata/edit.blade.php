@extends('layouts.app')

@section('content')
    <h2>Edit Penilaian</h2>
    <form action="{{ route('inputdata.updatePenilaian') }}" method="POST">
        @csrf
        <input type="hidden" name="id_penilaian" value="{{ $penilaian->id }}">
        <div>
            <label for="criteria">Kriteria</label>
            <select name="id_kriteria" id="criteria">
                @foreach($criterias as $criteria)
                    <option value="{{ $criteria->id }}" {{ $criteria->id == $penilaian->id_kriteria ? 'selected' : '' }}>
                        {{ $criteria->nama_kriteria }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="alternatif">Alternatif</label>
            <select name="id_alternatif" id="alternatif">
                @foreach($alternatifs as $alternatif)
                    <option value="{{ $alternatif->id }}" {{ $alternatif->id == $penilaian->id_alternatif ? 'selected' : '' }}>
                        {{ $alternatif->alternatif_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nilai">Nilai</label>
            <input type="number" name="nilai" id="nilai" value="{{ $penilaian->nilai }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
