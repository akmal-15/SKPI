@extends('admin-layouts.admin')

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
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Tahun Masuk</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mahasiswa as $m)
                                                <tr>
                                                    <td>{{ $m['nim'] }}</td>
                                                    <td>{{ $m['nama'] }}</td>
                                                    <td>{{ $m['prodi'] }}</td>
                                                    <td>{{ $m['thn_masuk'] }}</td>
                                                    
                                                    {{-- @include('admin-layouts.action') --}}
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $m['mahasiswa_id'] }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    
                                                        {{-- modal --}}
                                                        <div class="modal fade @if($pesan) {{ $pesan['id'] == $m['mahasiswa_id'] ? "show": "" }} @endif" id="editModal{{ $m['mahasiswa_id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Ubah Data Mahasiswa</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @if ($pesan)
                                                                            @if ($pesan['id'] == $m['mahasiswa_id'] )
                                                                                <div class="alert alert-warning" role="alert">
                                                                                    {{ $pesan['pesan'] }}
                                                                                </div>                                                                                
                                                                            @endif
                                                                        @endif
                                                                        <form method="POST" action="/admin/mahasiswa-update">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{ $m['mahasiswa_id'] }}">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nim</label>
                                                                                <input type="number" class="form-control" name="nim" value="{{ $m["nim"] }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Nama Mahasiswa</label>
                                                                                <input name="nama" type="text" class="form-control" value="{{ $m["nama"] }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tahun Masuk</label>
                                                                                <input name="thn" type="number" class="form-control" value="{{ $m["thn_masuk"] }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="prodi">Prodi</label>
                                                                                <select name="prodi" id="prodi" class="form-control">
                                                                                    <option value="" disabled hidden>Pilih Prodi</option>
                                                                                    <option name="ti" value="Teknik Informatika" {{ $m['prodi'] == "Teknik Informatika" ? "selected" : ""}}>Teknik Informatika</option>
                                                                                    <option name="si" value="Sistem Informasi" {{ $m['prodi'] == "Sistem Informasi" ? "selected" : ""}}>Sistem Informasi</option>
                                                                                    <option name="sk" value="Sistem Komputer" {{ $m['prodi'] == "Sistem Komputer" ? "selected" : ""}}>Sistem Komputer</option>
                                                                                </select>
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
                                                    
                                                    </td>
                                                    <td>
                                                        <form action="/admin/mahasiswa-delete" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $m['mahasiswa_id'] }}">
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
@endsection