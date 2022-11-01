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
                                                    <th>Nim</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Prodi</th>
                                                    <th>Lihat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mahasiswa as $m)
                                                    
                                                <tr>
                                                    <td>{{ $m['nim'] }}</td>
                                                    <td>{{ $m['nama'] }}</td>
                                                    <td>{{ $m['prodi'] }}</td>
                                                    <td>
                                                        <a href="/kaprodi/validasi-pengajuan-detail?mahasiswa={{ $m['mahasiswa_id'] }}" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-eye"></i>
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