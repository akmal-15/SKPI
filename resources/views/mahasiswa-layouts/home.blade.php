@extends('mahasiswa-layouts.mahasiswa')

@section('content')

<div class="content-wrapper">

    <section class="inner-page">
        <div class="container">

            <h3 style="text-align: center">Lengkapi Data Diri</h3>
            @if (session('status'))
            @if (session('status')["status"])
            <div class="alert alert-success mb-2">
                {{ session('status')["pesan"] }}
            </div>
            @else
            <div class="alert alert-danger mb-2">
                {{ session('status')["pesan"] }}
            </div>
            @endif
            @endif

            <form method="POST" action="/mahasiswa">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tahun Lulus</label>
                    <input type="number" class="form-control" name="tl" value="<?= $mhs['thn_lulus'] ? $mhs['thn_lulus'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Ijazah</label>
                    <input type="text" class="form-control" name="no_ijazah"value="<?= $mhs['no_ijazah'] ? $mhs['no_ijazah']: '' ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tempat dan Tanggal Lahir</label>
                    <input type="text" class="form-control" name="ttl" value="<?= $mhs['tempat_tanggal_lahir'] ? $mhs['tempat_tanggal_lahir'] : '' ?>">
                </div>

                <div class="mt-4 pt-2 text-right">
                    <input class="btn btn-primary btn-lg" type="submit" value="Simpan">
                </div>
            </form>
        </div>
        {{-- <div style="text-align: center">
            <h4>Tahun Lulus : {{ $mhs['thn_lulus'] }}</h4>
            <h4>Nomor Ijazah : {{ $mhs['no_ijazah'] }}</h4>
            <h4>Tempat Tanggal Lahir : {{ $mhs['tempat_tanggal_lahir'] }}</h4>
        </div>   --}}

    </section>
</div>

@endsection