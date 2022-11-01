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
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with minimal features & hover style</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Tahun Masuk</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>11218010</td>
                                                <td>
                                                    Manusia
                                                </td>
                                                <td>Informatika</td>
                                                <td>2018</td>
                                                <td>

                                                    <button type="button" class="btn btn-warning "><i class="fas fa-pencil-alt"></i></button>
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