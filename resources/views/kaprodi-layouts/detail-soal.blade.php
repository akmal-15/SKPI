@extends('kaprodi-layouts.kaprodi')

@section('content')
<div class="content-wrapper">

    @include('admin-layouts.breadcrumb')

    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
							<div class="container-fluid">
								<div class="card">
									<div class="card-body">
										<button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Soal</button>
                                        <h3 class="text-center">Total Soal: {{ $jumlah }}</h3>
									</div>
								</div>
							</div>
							<div class="container-fluid">
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
							</div>
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
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

				<form method="POST" action="/kaprodi/tambah-soal">
						@csrf
						<input type="hidden" name="id" value="{{ $id }}">
						{{-- <input type="hidden" name="id" value="3"> --}}
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
								<input type="text" name="soal[]" class="form-control" >
						</div>
						<div class="mb-3">
								<label class="form-label">Jawaban A</label>
								<input name="jawabanA[]" type="text" class="form-control">
						</div>
						<div class="mb-3">
								<label class="form-label">Jawaban B</label>
								<input name="jawabanB[]" type="text" class="form-control">
						</div>
						<div class="mb-3">
								<label class="form-label">Jawaban C</label>
								<input name="jawabanC[]" type="text" class="form-control">
						</div>
						<div class="mb-3">
								<label class="form-label">Jawaban D</label>
								<input name="jawabanD[]" type="text" class="form-control">
						</div>

						<div class="mb-3">
								<label class="form-label">Jawaban Benar</label>
								<select name="jawaban[]" class="form-control">
										<option value="">Pilih Jawaban</option>
										<option value="A">Jawaban A</option>
										<option value="B">Jawaban B</option>
										<option value="C">Jawaban C</option>
										<option value="D">Jawaban D</option>
								</select>
						</div>

						<div class="mt-4 pt-2 text-right">
								<input class="btn btn-primary" type="submit" value="Simpan">
						</div>
				</form>
      </div>
    </div>
  </div>
</div>

@endsection