@extends('mahasiswa-layouts.mahasiswa')

@section('content')

<div class="container-fluid mt-4">
    @if (session('pesan'))
        @if (session('pesan')["status"])
        <div class="alert alert-success mb-2">
            {{ session('pesan')["pesan"] }}
        </div>
        @else
        <div class="alert alert-danger mb-2">
            {{ session('pesan')["pesan"] }}
        </div>
        @endif
    @endif
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
                <th>Prestasi, Penghargaan atau Pengalaman </th>
                <th>Lihat Sertifikat</th>
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
                        <form action="/mahasiswa/pengajuan-delete" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $d['pengajuan_id'] }}">
                            <button type="submit" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach

            @foreach ($dokumen2 as $d)
            <tr>
                <td> {{ $d['kegiatan'] }} </td>
                <td><a href="{{ asset(" storage/" . $d['url']) }}" target="_blank" class="btn btn-primary"> <i
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
                    <form action="/mahasiswa/pengalaman-delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $d['pengalaman_id'] }}">
                        <button type="submit" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td>Nama materi </td>
                <td>: {{ !empty($nilai) ? $nilai[0]['materi'] : '-' }}</td>
            </tr>
            <tr>
                <td>Hasil nilai materi </td>
                <td>: {{ !empty($nilai) ? $nilai[0]['grade'] : '-' }}</td>
            </tr>
            
        </tbody>

    </table>

</div>
@endsection

@section('script')
@endsection