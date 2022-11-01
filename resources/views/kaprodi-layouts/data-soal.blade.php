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
                                                <th>Total Soal</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Php & Mysql</td>
                                                <td>30</td>
                                                <td>
                                                    <a href="/kaprodi/data-soal-detail">
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