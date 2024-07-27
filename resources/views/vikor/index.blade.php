@extends('layouts.app')

@section('content')

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
        {{ session('error') }}
    </div>
@endif

    <h1>Hasil VIKOR</h1>

    <!-- Decision Matrix (F) -->
    <h2>Matriks Keputusan (F)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach ($criterias as $c)
                    <th>{{ $c->criteria_name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($sample as $id_alternatif => $kriteria)
                <tr>
                    <td>{{ $alternatifs->find($id_alternatif)->alternatif_name }}</td>
                    @foreach ($kriteria as $id_kriteria => $nilai)
                        <td>{{ $nilai }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Normalization Matrix (N) -->
    <h2>Matriks Normalisasi (N)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach ($criterias as $c)
                    <th>{{ $c->criteria_name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($N as $id_alternatif => $kriteria)
                <tr>
                    <td>{{ $alternatifs->find($id_alternatif)->alternatif_name }}</td>
                    @foreach ($kriteria as $id_kriteria => $nilai)
                        <td>{{ number_format($nilai, 3) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Weighted Normalization Matrix (F*) -->
    <h2>Matriks Normalisasi Berbobot (F*)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach ($criterias as $c)
                    <th>{{ $c->criteria_name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($F_star as $id_alternatif => $kriteria)
                <tr>
                    <td>{{ $alternatifs->find($id_alternatif)->alternatif_name }}</td>
                    @foreach ($kriteria as $id_kriteria => $nilai)
                        <td>{{ number_format($nilai, 3) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Utility Measures (S and R) -->
    <h2>Ukuran Utilitas (S dan R)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                <th>S</th>
                <th>R</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($S as $id_alternatif => $s)
                <tr>
                    <td>{{ $alternatifs->find($id_alternatif)->alternatif_name }}</td>
                    <td>{{ number_format($s, 3) }}</td>
                    <td>{{ number_format($R[$id_alternatif], 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- VIKOR Index (Q) -->
    <h2>Indeks VIKOR (Q)</h2>
    @foreach ($Q as $v => $q_values)
        <h3>V = {{ $v }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Q</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($q_values as $id_alternatif => $q)
                    <tr>
                        <td>{{ $alternatifs->find($id_alternatif)->alternatif_name }}</td>
                        <td>{{ number_format($q, 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>*Alternatif Dengan Nilai Paling Kecil Adalah Yang Terbaik</h3>
    @endforeach

@endsection
