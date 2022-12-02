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
                        @foreach($soal as $i => $v)
                            <div class="col-12 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Soal {{ $i+1 }}</th>
                                                    <td>{{ $v['soal'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jawaban A</th>
                                                    <td>{{ $v['jawaban_1'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jawaban B</th>
                                                    <td>{{ $v['jawaban_2'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jawaban C</th>
                                                    <td>{{ $v['jawaban_3'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jawaban D</th>
                                                    <td>{{ $v['jawaban_4'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jawaban</th>
                                                    <td>{{ $v['jawaban'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Opsi</th>
                                                    @include('kaprodi-layouts.action-detail-soal')
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                        @endForeach
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

@endsection