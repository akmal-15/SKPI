@extends('kaprodi-layouts.kaprodi')

@section('content')
    <div class="content-wrapper">
    
        @include('admin-layouts.breadcrumb')
    
        <section class="content">
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
                                                    <th>Nama Materi</th>
                                                    <th>Deskripsi</th>
                                                    <th>Waktu Soal</th>
                                                    <th>Waktu Expired</th>
                                                    <th>Edit</th>
                                                    <th>Hapus</th>
    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                    @foreach ($materi as $m)
                                                <tr>
                                                    <td>{{ $m['nama_materi'] }}</td>
                                                    <td>{{ $m['deskripsi'] }}</td>
                                                    <td>{{ $m['waktu_soal'] }}</td>
                                                    <td>{{ $m['waktu_exp'] }}</td>

                                                    <td>
                                                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $m['materi_id'] }}">
                                                            edit
                                                        </button> --}}
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                                data-target="#editModal{{ $m['materi_id'] }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                    </td>

                                                    <td>
                                                        <form action="/kaprodi/materi-delete" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $m['materi_id'] }}">
                                                            <button type="submit" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash"></i></button>
                                                        </form>
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

    {{-- modal --}}

    @foreach ($materi as $m)
        <div class="modal fade @if($pesan) {{ $pesan['id'] == $m['materi_id'] ? " show": "" }} @endif"
            id="editModal{{ $m['materi_id'] }}" data-keyboard="false" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Ubah Data Materi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($pesan)
                        @if ($pesan['id'] == $m['materi_id'] )
                        <div class="alert alert-warning" role="alert">
                            {{ $pesan['pesan'] }}
                        </div>
                        @endif
                        @endif
                        <form method="POST" action="/kaprodi/materi-update">
                            @csrf
                            <input type="hidden" name="id" value="{{ $m['materi_id'] }}">
                            <div class="mb-3">
                                <label class="form-label">Nama Materi</label>
                                <input type="text" class="form-control" name="nama_materi" value="{{ $m["nama_materi"] }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input name="deskripsi" type="text" class="form-control" value="{{ $m["deskripsi"] }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu Soal</label>
                                <input name="waktu_soal" type="number" class="form-control" value="{{ $m["waktu_soal"] }}">
                            </div>
                            <div class="mb-3">
                                <label for="prodi">Waktu Expired</label>
                                <input name="waktu_exp" type="datetime-local" class="form-control" value="{{ date('Y-m-d\Th:m', strtotime($m["waktu_exp"])) }}">
                            </div>
                            <div class="mb-3">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection