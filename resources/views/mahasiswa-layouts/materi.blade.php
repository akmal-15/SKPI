@extends('mahasiswa-layouts.mahasiswa')

@section('content')
    <div class="content-wrapper">
    
        <section class="content">
            <div class="container-fluid">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                @if ($pesan)
                                @if ($pesan["status"])
                                <div class="alert alert-success mb-2">
                                    {{ $pesan["pesan"] }}
                                </div>
                                @else
                                <div class="alert alert-danger mb-2">
                                    {{ $pesan["pesan"] }}
                                </div>
                                @endif
                                @endif
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Materi</th>
                                                    <th>Deskripsi</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($materi as $m)
                                                <tr>
                                                    
                                                <td>{{ $m['nama_materi'] }}</td>
                                                <td>{{ $m['deskripsi'] }}</td>

                                                    <td>
                                                        <a href="/mahasiswa/materi-detail?id={{ $m['materi_id'] }}">
                                                            {{-- pake filter --}}
                                                            {{-- <button type="button" class="btn {{ $m['materi_id'] == $ma_ac ? 'btn-success' : 'btn-danger' }} btn-sm">
                                                                Pilih
                                                            </button> --}}

                                                            {{-- tanpa filter --}}
                                                            <button type="button" class="btn btn-success btn-sm">
                                                                Pilih
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
    
                                            </tbody>
    
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
        </section>
    
    </div>
@endsection