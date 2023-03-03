@extends('kaprodi-layouts.kaprodi')

@section('content')
<div class="content-wrapper">

    @include('admin-layouts.breadcrumb')

    {{-- <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>

                                            <tr>
                                                <th>Kegiatan 1</th>
                                                <td>prestasi lomba</td>
                                            </tr>

                                            <tr>
                                                <th>Link </th>
                                                <td>link</td>
                                            </tr>

                                            <tr>
                                                <th>Kegiatan 2</th>
                                                <td>pengalaman magang</td>
                                            </tr>

                                            <tr>
                                                <th>link </th>
                                                <td>link </td>
                                            </tr>

                                            <tr>
                                                <th>Kegiatan 3</th>
                                                <td>pengalaman organisasi</td>
                                            </tr>

                                            <tr>
                                                <th>link </th>
                                                <td>link </td>
                                            </tr>

                                            <tr>
                                                <th>Opsi</th>
                                                <td><button type="button" class="btn btn-success">Terima</button>
                                                    <button type="button" class="btn btn-danger ml-4">Tolak</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                            </tr>

                                        </thead>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </section> --}}

    <div class="container-fluid">

        @if (session('pesan'))
            @if (session('pesan')['status'])
                <div class="alert alert-success">
                    {{ session('pesan')['pesan'] }}
                </div>
            @else
                <div class="alert alert-danger">
                    {{ session('pesan')['pesan'] }}
                </div>                
            @endif
        @endif
        
        <table id="" class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Lihat Sertifikat</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dokumen as $d)
                <tr>
                    <td>{{ $d['kegiatan'] }}</td>
                    <td><a href="/storage/{{ $d['kegiatan_url'] }}" target="_blank" class="btn btn-primary"> <i
                                class="fas fa-eye"></i> </a></td>
                    <td>
                        @if ($d['status'])
                            Di Terima
                        @else
                            Di Tolak
                        @endif
                    </td>
                    
                    <td>
                        @if (!$mahasiswa->validasi_dokumen)
                            <form action="/kaprodi/validasi-pengajuan-update" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $d['pengajuan_id'] }}">
                                <button type="submit" class="btn btn-warning ">Ubah Status</button>                            
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                @foreach ($dokumen2 as $d)
                <tr>
                    <td>{{ $d['kegiatan'] }}</td>
                    <td><a href="/storage/{{ $d['url'] }}" target="_blank" class="btn btn-primary"> <i class="fas fa-eye"></i>
                        </a></td>
                    <td>
                        @if ($d['status'])
                        Di Terima
                        @else
                        Di Tolak
                        @endif
                    </td>
                
                    <td>
                        @if (!$mahasiswa->validasi_dokumen)
                        <form action="/kaprodi/validasi-pengalaman-update" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $d['pengalaman_id'] }}">
                            <button type="submit" class="btn btn-warning ">Ubah Status</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        <div class="container-fluid ">
            <div class="">
                @if ($mahasiswa->validasi_dokumen)
                    {{-- BATAL KONFIRMASI --}}
                    <form action="/kaprodi/konfirmasi-validasi-batal" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $mahasiswa->mahasiswa_id }}">
                        <button type="submit" class="btn btn-danger ml-3 ">Batal Konfirmasi Pengajuan</button></td>
                    </form>
                @else
                    {{-- INGIN KONFIRMASI --}}
                    <form action="/kaprodi/konfirmasi-validasi" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $mahasiswa->mahasiswa_id }}">
                        <button type="submit" class="btn btn-success ml-3 ">Konfirmasi Pengajuan</button></td>
                    </form>
                @endif
                {{-- <button type="button" class="btn btn-danger ml-5 ">Tolak</button> --}}
            </div>
        </div>
    </div>


</div>
@endsection