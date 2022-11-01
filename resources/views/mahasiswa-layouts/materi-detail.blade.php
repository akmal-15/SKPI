@extends('mahasiswa-layouts.mahasiswa')

@section('content')
       <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
    
                        <div class="card-body">
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <td>30 menit</td>
                                    </tr>
    
                                    <tr>
                                        <th>Total Soal</th>
                                        <td>20 soal</td>
                                    </tr>
    
                                    <tr>
                                        <th>Aturan</th>
                                        <td>Lorem ipsum dolor sit amet. </td>
                                    </tr>
    
                                    <tr>
                                        <th>Opsi</th>
                                        <td>
                                            <a href="/mahasiswa/soal">
                                                <button type="button" class="btn btn-danger ">Mulai</button>
                                            </a>
                                        </td>
    
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
@endsection