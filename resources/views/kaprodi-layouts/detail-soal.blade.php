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
                                        <table id="" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Soal 1</th>
                                                    <td>kenapa bagaimana?</td>
                                                </tr>

                                                <tr>
                                                    <th>Jawaban 1</th>
                                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium</td>
                                                </tr>

                                                <tr>
                                                    <th>Jawaban 2</th>
                                                    <td>Lorem ipsum dolor sit amet. </td>
                                                </tr>

                                                <tr>
                                                    <th>Jawaban 3</th>
                                                    <td>Lorem ipsum dolor sit amet. </td>
                                                </tr>

                                                <tr>
                                                    <th>Jawaban 4</th>
                                                    <td>Lorem ipsum dolor sit amet. </td>
                                                </tr>

                                                <tr>
                                                    <th>Jawaban</th>
                                                    <td>Jawaban 2</td>
                                                </tr>
    
                                                <tr>
                                                    <th>Opsi</th>
                                                    @include('kaprodi-layouts.action-detail-soal')
                                                    
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <td></td>
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
            </div>
        </section>
    
    </div>
@endsection