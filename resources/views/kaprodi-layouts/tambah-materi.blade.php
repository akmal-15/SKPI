@extends('kaprodi-layouts.kaprodi')

@section('content')
<div class="content-wrapper">

    @include('admin-layouts.breadcrumb')

    <section class="vh-100 ">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-50">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            {{-- <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3> --}}

                            @if (session('status'))
                            @if (session('status')["status"])
                            <div class="alert alert-success mb-2">
                                {{ session('status')["pesan"] }}
                            </div>
                            @else
                            <div class="alert alert-danger mb-2">
                                {{ session('status')["pesan"] }}
                            </div>
                            @endif
                            @endif

                            <form method="POST" action="/kaprodi/tambah-materi">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Materi</label>
                                    <input type="text" class="form-control" name="nama_materi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Waktu Soal ( menit )</label>
                                    <input type="number" class="form-control" name="waktu_soal">
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">Grade Soal</label>
                                    <select name="form-control" id="" name="nilai">
                                        <option value="">==== Pilih Grade ====</option>
                                        <option value=""></option>
                                    </select>
                                </div> --}}
                                <div class="mb-3">
                                    <label class="form-label">Waktu Exp</label>
                                    <input type="datetime-local" class="form-control" name="waktu_exp">
                                </div>

                                <div class="mt-4 pt-2 text-right">
                                    <input class="btn btn-primary btn-lg" type="submit" value="Simpan">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection