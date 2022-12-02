@extends('kaprodi-layouts.kaprodi')

@section('content')
    <div class="content-wrapper">
    
        @include('admin-layouts.breadcrumb')

    <div class="text-right mr-5">
        <button type="button" class="btn btn-success ml-3 btn-tambah">Tambah Kolom</button>
    </div>

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

                                <form method="POST" action="/kaprodi/tambah-soal">
                                    @csrf
                                    {{-- <input type="hidden" name="id" value="{{ $id }}"> --}}
                                    <input type="hidden" name="id" value="3">
                                    {{-- <div class="mb-3" id="soal">
                                        <label class="form-label">Materi</label>
                                        <select class="form-control" name="materi_id[]">
                                            <option value="">Pilih Materi</option>
                                            <option value="">Materi 1</option>
                                            <option value="">Materi 2</option>
                                        </select>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label class="form-label">Soal</label>
                                        <textarea name="soal[]" cols="40" rows="3" class="form-control">asawas</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jawaban 1</label>
                                        <input name="jawabanA[]" type="text" class="form-control" value="asawas">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jawaban 2</label>
                                        <input name="jawabanB[]" type="text" class="form-control" value="asawas">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jawaban 3</label>
                                        <input name="jawabanC[]" type="text" class="form-control" value="asawas">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jawaban 4</label>
                                        <input name="jawabanD[]" type="text" class="form-control" value="asawas">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jawaban Benar</label>
                                        <select name="jawaban[]" class="form-control">
                                            <option value="">Pilih Jawaban</option>
                                            <option value="A" selected>Jawaban A</option>
                                            <option value="B">Jawaban B</option>
                                            <option value="C">Jawaban C</option>
                                            <option value="D">Jawaban D</option>
                                        </select>
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

@section('script')
<script>
    $(document).on("click",".btn-tambah", function(e){
        e.preventDefault()
        let html = `<div class="col-12 row">
            <div class="col-md-3 mb-4">
        
        <div class="mb-3">
            <label class="form-label">Materi</label>
            <select class="form-control" name="materi_id[]">
                <option value="">Pilih Materi</option>
                <option value="">Materi 1</option>
                <option value="">Materi 2</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Soal</label>
            <textarea name="soal[]" cols="40" rows="3" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Jawaban 1</label>
            <input name="jawaban1[]" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Jawaban 2</label>
            <input name="jawaban2[]" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Jawaban 3</label>
            <input name="jawaban3[]" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Jawaban 4</label>
            <input name="jawaban4[]" type="text" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Jawaban</label>
            <select name="jawaban[]" class="form-control">
                <option value="">Pilih Jawaban</option>
                <option value="">Jawaban 1</option>
                <option value="">Jawaban 2</option>
                <option value="">Jawaban 3</option>
                <option value="">Jawaban 4</option>
            </select>
        </div>
        
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                <button type="button" class=" btn btn-danger btn-sm btn-hapus">X</button>
            </div>
        </div>`
        $("#kaprodi").append(html)
    })
    $(document).on("click",".btn-hapus", function(e){
        e.preventDefault()
        $(this).parent().parent().html('')
    })
</script>
@endsection