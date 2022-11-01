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
                                <div class="card">
    
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
                                                <tr>
                                                    <td>isi nama materi</td>
                                                    <td>isi deskripsi</td>
                                                    <td>
                                                        <a href="/mahasiswa/materi-detail">
                                                            <button type="button" class="btn btn-success btn-sm">
                                                                Pilih
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>isi nama materi</td>
                                                    <td>isi deskripsi
                                                    </td>
                                                    <td>
                                                        <a href="">
                                                            <button type="button" class="btn btn-success btn-sm">
                                                                Pilih
                                                            </button>
                                                        </a>
                                                    </td>
    
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