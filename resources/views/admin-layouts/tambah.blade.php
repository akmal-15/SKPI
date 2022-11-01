@extends('admin-layouts.admin')

@section('content')
<div class="content-wrapper">

    @include('admin-layouts.breadcrumb')

    <div class="text-right mr-5">
        <button type="button" class="btn btn-success ml-3 btn-tambah">Tambah Kolom</button>
    </div>

    <section class="vh-100 ">
        <div class="container py-5 h-100">
            <div class="row  align-items-center h-200">
                <div class="">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
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
                            <form action="/admin/mahasiswa-tambah" method="POST">
                                @csrf
                                <div class="row" id="mahasiswa">
                                    <div class="col-12 row">

                                        <div class="col-md-3 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label">Nim</label>
                                                <input type="number" class="form-control form-control-lg" name="nim[]">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="lastName">Nama Mahasiswa</label>
                                                <input type="text" class="form-control form-control-lg" name="nama[]">
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <label for="birthdayDate" class="form-label">Tahun Masuk</label>
                                                <input type="number" class="form-control form-control-lg"
                                                    name="tahun[]">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <label>Prodi</label>
                                                <select class="form-control" name="prodi[]">
                                                    <option value="">Pilih Prodi</option>
                                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                                    <option value="Sistem Komputer">Sistem Komputer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                                            {{-- <button type="button"
                                                class=" btn btn-danger btn-sm btn-hapus">X</button> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2 text-center">
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

@section('script')
<script>
    $(document).on("click",".btn-tambah", function(e){
        e.preventDefault()
        let html = `<div class="col-12 row">
        
            <div class="col-md-3 mb-4">
                <div class="form-outline">
                    <label class="form-label">Nim</label>
                    <input type="number" class="form-control form-control-lg" name="nim[]" />
                </div>
            </div>
        
            <div class="col-md-3 mb-4">
                <div class="form-outline">
                    <label class="form-label" for="lastName">Nama Mahasiswa</label>
                    <input type="text" class="form-control form-control-lg" name="nama[]" />
                </div>
            </div>
        
            <div class="col-md-2 mb-4 d-flex align-items-center">
                <div class="form-outline">
                    <label for="birthdayDate" class="form-label">Tahun Masuk</label>
                    <input type="number" class="form-control form-control-lg" name="tahun[]" />
                </div>
            </div>
        
            <div class="col-md-3 mb-4 d-flex align-items-center">
                <div class="form-outline">
                    <label>Prodi</label>
                    <select class="form-control" name="prodi[]">
                        <option value="">Pilih Prodi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Sistem Komputer">Sistem Komputer</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                <button type="button" class=" btn btn-danger btn-sm btn-hapus">X</button>
            </div>
        </div>`
        $("#mahasiswa").append(html)
    })
    $(document).on("click",".btn-hapus", function(e){
        e.preventDefault()
        $(this).parent().parent().html('')
    })
</script>
@endsection