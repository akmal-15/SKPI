@extends('kaprodi-layouts.kaprodi')

@section('content')
<div class="content-wrapper">

    @include('admin-layouts.breadcrumb')

    <section class="content">
        <div class="container-fluid">
<div class="container">



    @if ($pengajuan)
    <h3 class="text-center my-5">sudah terkonfirmasi</h3>
    @else
    
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
    <form action="/kaprodi/capaian-pembelajaran" method="POST" enctype="multipart/form-data">
        {{-- <div class="text-center">
        </div> --}}
        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary ">Simpan</button>
            <button type="button" class="btn btn-success btn-tambah">Tambah Kolom</button>
        </div>
        @csrf
        {{-- <input type="hidden" value="{{ $mahasiswa['mahasiswa_id'] }}" name="id"> --}}
        <div class="row" id="form-wrapper">
            @foreach($cp as $val)
                <div class="col-12 row mt-5">
                        <div class="col-11">
                            <div class="form-group mb-2">
                                <label class="mb-2">Kemampuan Kerja</label>
                                <input name='kk[]' type="text" class="form-control" value="<?= $val->kemampuan_kerja ? $val->kemampuan_kerja : '' ?>">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2">Penguasaan Pengetahuan</label>
                                <input name='pp[]' type="text" class="form-control"value="<?= $val->penguasaan_pengetahuan ? $val->penguasaan_pengetahuan : '' ?>">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2">Sikap Khusus</label>
                                <input name='sk[]' type="text" class="form-control"value="<?= $val->sikap_khusus ? $val->sikap_khusus : '' ?>">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Prodi</label>
                                <select class="form-control" name="prodi[]">
                                    <option value="Teknik Informatika" {{ $val->prodi == 'Tekmik Informatika' ? 'selected' : ''  }}>Teknik Informatika</option>
                                    <option value="Sistem Informasi" {{ $val->prodi == 'Sistem Informasi' ? 'selected' : ''  }}>Sistem Informasi</option>
                                    <option value="Sistem Komputer" {{ $val->prodi == 'Sistem Komputer' ? 'selected' : ''  }}>Sistem Komputer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-1 d-flex justify-content-center align-items-center">
                            <button type="button" class=" btn btn-danger btn-sm btn-hapus" style="width: 100%;height: 40%;">X</button>
                        </div>
                </div>
            @endforeach
            </div>
    </form>
            @endif
        </div>
    </div>
</div>

</div>
@endsection

@section('script')
<script>
    $(document).on("click",".btn-tambah", function(e){
        e.preventDefault()
        let html = `<div class="col-12 row mt-5">
            <div class="col-11">
                <div class="form-group mb-2">
                    <label class="mb-2">Kemampuan Kerja</label>
                    <input name='kk[]' type="text" class="form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-2">Penguasaan Pengetahuan</label>
                    <input name='pp[]' type="text" class="form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-2">Sikap Khusus</label>
                    <input name='sk[]' type="text" class="form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label class="form-label">Prodi</label>
                    <select class="form-control" name="prodi[]">
                        <option value="pilih prodi">Pilih Prodi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Sistem Komputer">Sistem Komputer</option>
                    </select>
                </div>
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <button type="button" class=" btn btn-danger btn-sm btn-hapus" style="width: 100%;height: 40%;">X</button>
            </div>
        </div>`
        $("#form-wrapper").prepend(html)
        // $("#form-wrapper").append(html)
    })
    $(document).on("click",".btn-hapus", function(e){
        e.preventDefault()
        $(this).parent().parent().html('')
    })
</script>
@endsection