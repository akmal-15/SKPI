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
                                                    <th>Tahun Masuk</th>
                                                    <th>Lihat</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>11218010</td>
                                                    <td>
                                                        Aa Bayu Saputra
                                                    </td>
                                                    <td>Teknik Informatika</td>
                                                    <td>2018</td>
                                                   <td>
                                                    <a href="">
                                                        <button type="button" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </a>
                                                   </td>
                                                </tr>

                                                <tr>
                                                    <td>11218021</td>
                                                    <td>
                                                        Akmal Satria Irawan
                                                    </td>
                                                    <td>Teknik Informatika</td>
                                                    <td>2018</td>
                                                    <td>
                                                        <a href="">
                                                            <button type="button" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
    
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