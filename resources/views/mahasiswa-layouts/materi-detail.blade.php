@extends('mahasiswa-layouts.mahasiswa')

@section('content')
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">

					@if (session('pesan'))
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
					<div class="card-body">
						<table id="" class="table table-bordered table-hover">
							<thead>

								<tr>
									<th>nama materi</th>
									<td>{{ $materi['nama_materi'] }}</td>
								</tr>
								<tr>
									<th>deskripsi</th>
									<td>{{ $materi['deskripsi'] }}</td>
								</tr>
								<tr>
									<th>Waktu</th>
									<td>{{ $materi['waktu_soal'] }}</td>
								</tr>

								<tr>
									<th>Total Soal</th>
									<td>20 soal</td>
								</tr>

								<tr>
									<th>Opsi</th>
									<td>
										<form action="/mahasiswa/materi-detail" method="post">
											@csrf()
											<input type="hidden" name="materi" value="{{ $materi['materi_id'] }}">
											<button type="submit" class="btn btn-danger ">Mulai</button>
										</form>
									</td>

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
@endsection