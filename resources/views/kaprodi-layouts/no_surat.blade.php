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

                            @if (session('pesan'))
                            @if (session('pesan')["status"])
                            <div class="alert alert-success mb-2">
                                {{ session('pesan')["pesan"] }}
                            </div>
                            @else
                            <div class="alert alert-danger mb-2">
                                {{ session('pesan')["pesan"] }}
                            </div>
                            @endif
                            @endif

                            <form method="POST" action="/kaprodi/no-surat">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tahun Lulus</label>
                                    <input type="text" class="form-control" name="thn_lulus">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" name="ns">
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