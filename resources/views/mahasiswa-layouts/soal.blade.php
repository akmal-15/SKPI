@extends('mahasiswa-layouts.mahasiswa')

@section('content')
<div class="container mt-5">
	<div class="">
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
	</div>
	<div class="">
		<h4>{{ $materi->nama_materi }}</h4>
	</div>
	<div class="d-flex">
		<div class="col-md-10 col-lg-10">
			<div class="border">
				<div class="question bg-white p-3 border-bottom">
					<div class="d-flex flex-row justify-content-between align-items-center mcq">
						<h6>End Time : {{ $materi_action['end_at'] }}</h6><span>({{ $page }} of {{ count($soal_list) }})</span>
					</div>
				</div>
				<div class="question bg-white p-3 border-bottom">
					<div class="d-flex flex-row align-items-center question-title">
						<h3 class="text-danger">{{ $page }}. </h3>
						<h5 class="mt-1 ml-2">{{ $soal['soal'] }}</h5>
					</div>
					<div class="ans d-block">
						<label class="radio w-100"> <input type="radio" name="jawaban_group" value="a" <?=$jawaban=='a' ? 'selected'
								: '' ?>> <span class="w-100">{{
								$soal['jawaban_1'] }}</span>
						</label>
					</div>
					<div class="ans d-block">
						<label class="radio w-100"> <input type="radio" name="jawaban_group" value="b" <?=$jawaban=='b' ? 'selected'
								: '' ?>> <span class="w-100">{{
								$soal['jawaban_2'] }}</span>
						</label>
					</div>
					<div class="ans d-block">
						<label class="radio w-100"> <input type="radio" name="jawaban_group" value="c" <?=$jawaban=='c' ? 'selected'
								: '' ?>>
							<span class="w-100">{{ $soal['jawaban_3'] }}</span>
						</label>
					</div>
					<div class="ans d-block ">
						<label class="radio w-100"> <input type="radio" name="jawaban_group" value="d" <?=$jawaban=='d' ? 'selected'
								: '' ?>> <span class="w-100">{{
								$soal['jawaban_4'] }}</span>
						</label>
					</div>
				</div>
				<div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
					<div class="">

						@if ($page > 1)
						<form action="/mahasiswa/soal" method="post">
							@csrf()
							<input type="hidden" name="soal_id" value="{{ $id }}">
							<input type="hidden" name="url" value="/mahasiswa/soal?page={{ $page - 1 }}&id={{ $id }}">
							<button class="btn btn-primary d-flex align-items-center btn-danger" type="submit"><i
									class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
						</form>
						@endif
					</div>
					<div class="">

						@if ($page < count($soal_list)) <form action="/mahasiswa/soal" method="post">
							@csrf()
							<input type="hidden" name="soal_id" value="{{ $id }}">
							<input type="hidden" name="url" value="/mahasiswa/soal?page={{ $page + 1 }}&id={{ $id }}">
							<button class="btn btn-primary border-success align-items-center btn-success" type="submit">Next <i
									class="fa fa-angle-right ml-2"></i></button>
							</form>
							@endif
					</div>
				</div>
			</div>
		</div>
		<div class="mr-auto p-1 d-flex flex-wrap">
			@foreach ($soal_list as $i => $v)
			<form action="/mahasiswa/soal" method="post">
				@csrf()
				<input type="hidden" name="soal_id" value="{{ $id }}">
				<input type="hidden" name="url" value="/mahasiswa/soal?page={{ $i+1 }}&id={{ $id }}">
				<button type="submit" class="btn btn-dark m-1">{{ $i +1 }}</button>
			</form>
			@endforeach
		</div>
	</div>
</div>
@endsection

@section('script')
<style>
	body {
		background-color: #eee;
	}

	label.radio {
		cursor: pointer;
	}

	label.radio input {
		position: absolute;
		top: 0;
		left: 0;
		visibility: hidden;
		pointer-events: none;
	}

	label.radio span {
		padding: 4px 0px;
		border: 1px solid red;
		display: inline-block;
		color: red;
		width: 100px;
		text-align: center;
		border-radius: 3px;
		margin-top: 7px;
		text-transform: uppercase;
	}

	label.radio input:checked+span {
		border-color: red;
		background-color: red;
		color: #fff;
	}

	.ans {
		margin-left: 36px !important;
	}

	.btn:focus {
		outline: 0 !important;
		box-shadow: none !important;
	}

	.btn:active {
		outline: 0 !important;
		box-shadow: none !important;
	}
</style>
<script>
	$('form').submit(function(eventObj) {
		let value = $("input[name='jawaban_group']:checked").val();
    $(this).append(`<input type="hidden" name="jawaban" value="${value == undefined ? '' : value}">`);
    return true;
	});
</script>
@endsection