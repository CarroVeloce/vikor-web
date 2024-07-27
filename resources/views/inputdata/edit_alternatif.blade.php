@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-800 mb-8">Edit Alternatif</h1>

<div class="p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
    <form action="{{ route('inputdata.updateAlternatif', $alternatif->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="alternatif_code" class="block text-gray-600 text-sm font-medium mb-2">Alternatif Code</label>
            <input id="alternatif_code" type="text" name="alternatif_code" value="{{ $alternatif->alternatif_code }}"
                class="form-input">
        </div>
        <div class="form-group">
            <label for="alternatif_name" class="block text-gray-600 text-sm font-medium mb-2">Alternatif Name</label>
            <input id="alternatif_name" type="text" name="alternatif_name" value="{{ $alternatif->alternatif_name }}"
                class="form-input">
        </div>
        <button type="submit" class="btn-submit">Update Alternatif</button>
    </form>
</div>

@endsection
