@extends('layouts.layout_login')

@section('content_login')

<div id="page-wrapper" style="margin: 0;background: transparent;">
    <div class="main-page login-page ">
        <h2 class="title1">Đăng nhập</h2>
        <div class="widget-shadow">
            <div class="login-body">
                @if(session('notification'))
                <div class="alert alert-warning" role="alert">
                    {{ session('notification') }}
                </div>
                @endif
                <form action="" method="post">
                    @csrf
                    <input id="email" type="email" class="user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Nhập Email ..." autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="password" type="password" class="lock @error('password') is-invalid @enderror" placeholder="Nhập Password ..." name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="row mb-0">
                        <div class="offset-md-4">
                            <button type="submit" class="btn btn-primary" style="display: block;width: 100%;">
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection