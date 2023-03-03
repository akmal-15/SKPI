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
                                    @if (session('pesan'))
                                    @if (session('pesan')['status'])
                                    <div class="alert alert-success mb-3">
                                        {{ session('pesan')['pesan'] }}
                                    </div>
                                    @else
                                    <div class="alert alert-danger mb-3">
                                        {{ session('pesan')['pesan'] }}
                                    </div>
                                    @endif
                                    @endif

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
                                                @foreach ($mahasiswa as $m)

                                            <tr>
                                                <td>{{ $m['nim'] }}</td>
                                                <td>{{ $m['nama'] }}</td>
                                                <td>{{ $m['prodi'] }}</td>
                                                <td>{{ $m['thn_masuk'] }}</td>
                                                <td>
                                                    <a href="/kaprodi/dokumen/skpi/{{ $m['mahasiswa_id'] }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach


                                            {{-- <a href="/kaprodi/dokumen/skpi/1">
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    skpi
                                                </button>
                                            </a> --}}
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