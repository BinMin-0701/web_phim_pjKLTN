@extends('layouts.layout_login')

@section('content_login')

<div id="page-wrapper" style="margin: 0;background: transparent;">
    <div class="main-page login-page ">
        <h2 class="title1">Đăng nhập</h2>
        <div class="widget-shadow">
            <div class="login-body">
                <form action="" method="post">
                    @csrf
                    <input id="email" type="email" class="user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Nhập Email ..." autofocus>
                    @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                    <!-- Tự css lại nhé -->
                    <input id="name" type="text" class="user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nhập tên ...">

                    @error('name')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <!-- Tự css lại nhé -->


                    <input id="password" type="password" class="lock @error('password') is-invalid @enderror" placeholder="Nhập Password ..." name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="password_confirmation" type="password" class="lock @error('password_confirmation') is-invalid @enderror" placeholder="Nhập Lại Password ..." name="password_confirmation" required autocomplete="current-password">

                    @error('password_confirmation')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="row mb-0">
                        <div class="offset-md-4">
                            <button type="submit" class="btn btn-primary" style="display: block;width: 100%;">
                                Đăng ký
                            </button>
                        </div>
                    </div>
                    <div class="registration">
                        <a class="" href="./login">
                            Đã có tài khoản
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection