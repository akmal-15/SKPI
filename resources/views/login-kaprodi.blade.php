@extends('auth.login')

@section('login')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>{{ $title }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">SKPI FTI UNSERA</p>
            @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
            @endif
            <form action="/login-kaprodi" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Kode Dosen" name="kode-dosen" value="11218011">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="pass" value="12345678">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 ">
                <a href="/" class="text-center">Kembali</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection