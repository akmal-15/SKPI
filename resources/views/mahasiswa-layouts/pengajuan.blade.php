@extends('mahasiswa-layouts.mahasiswa')

@section('content')

<div class="container">


   
    @if ($pengajuan)
        <h3 class="text-center my-5">sudah terkonfirmasi</h3>
    @else
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-success ml-3 btn-tambah">Tambah Kolom</button>
        </div>
        
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
        <form action="/mahasiswa/pengajuan" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $mahasiswa['mahasiswa_id'] }}" name="id">
            <div class="row" id="form-wrapper">
                {{-- <div class="col-12">
                    <div class="form-group mb-2">
                        <label class="mb-2">Nama Kegiatan</label>
                        <input name='kegiatan[]' type="text" class="form-control" id="">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-2">Link</label>
                        <input name='link[]' accept="application/pdf" type="file" class="form-control" id="">
                    </div>
                </div> --}}
            </div>
        
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 mb-4 ">Simpan</button>
            </div>
        
        </form>
    @endif


</div>
@endsection

@section('script')
<script>
    $(document).on("click",".btn-tambah", function(e){
        e.preventDefault()
        let html = `<div class="col-12 row">
            <div class="col-11">
                <div class="form-group mb-2">
                    <label class="mb-2">Prestasi atau Penghargaan</label>
                    <input name='kegiatan[]' type="text" class="form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label class="mb-2">Upload Sertifikat</label>
                    <input name='link[]' accept="application/pdf" type="file" class="form-control" id="">
                </div>
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <button type="button" class=" btn btn-danger btn-sm btn-hapus" style="width: 100%;height: 40%;">X</button>
            </div>
        </div>`
        $("#form-wrapper").append(html)
    })
    $(document).on("click",".btn-hapus", function(e){
        e.preventDefault()
        $(this).parent().parent().html('')
    })
</script>
@endsection