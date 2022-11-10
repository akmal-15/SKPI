@extends('mahasiswa-layouts.mahasiswa')

@section('content')

<div class="container-fluid mt-4">
    @if ($mahasiswa['validasi_dokumen'])
        <div class="d-flex justify-content-end">
            <a href="/mahasiswa/dokumen_akhir" class="btn btn-success ">Download SKPI</a>
        </div>
    @endif
    {{-- <tr>
        <th>Keterangan Pengajuan: </th>
        <td>Belum di Lihat Keseluruhan</td>
    </tr> --}}



    <table id="" class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Lihat Bukti</th>
                <th>Info</th>
                <th>Hapus</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($dokumen as $d)
            <tr>
                <td>{{ $d['kegiatan'] }}</td>
                <td><a href="{{ asset("storage/" . $d['kegiatan_url']) }}" target="_blank" class="btn btn-primary"> <i
                            class="fas fa-eye"></i> </a></td>
                <td>
                    @if ($d['status'])
                        Di Terima
                    @else
                        Di Tolak
                    @endif
                </td>
                <td>
                    @if (!$mahasiswa['validasi_dokumen'])
                        <form action="/mahasiswa/dokumen-delete" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $d['pengajuan_id'] }}">
                            <button type="submit" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection

@section('script')
@endsection