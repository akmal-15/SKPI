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
                                                    <th>Waktu</th>
                                                    <th>Total Soal</th>
                                                    <th>Edit</th>
                                                    <th>Hapus</th>
    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Php & Mysql</td>
                                                    <td>
                                                        Bahasa pemograman Php dan database mysql
                                                    </td>
                                                    <td>40 menit</td>
                                                    <td>30</td>
                                                   @include('kaprodi-layouts.action-materi')
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