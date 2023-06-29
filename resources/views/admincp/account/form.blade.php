@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Quản Lý Tài khoản</div>

        @if ($errors->any())
        @foreach ($errors->all() as $err)
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{$err}}!
        </div>
        @endforeach
        @endif
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          @if(!isset($account))
          {!! Form::open(['route'=>'account.store','method'=>'POST']) !!}
          @else
          {!! Form::open(['route'=>['account.update',$account->id],'method'=>'PUT']) !!}
          @endif
          <div class="form-group">
            {!! Form::label('email', 'Email đăng nhập', []) !!}
            {!! Form::text('email', isset($account) ? $account->email : '', ['class'=>'form-control','placeholder'=>'...']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('name', 'Tên người dùng', []) !!}
            {!! Form::textarea('name', isset($account) ? $account->name : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('password', 'Mật khẩu', []) !!}
            {!! Form::password('password',['class'=>'form-control','placeholder'=>'...']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('level', 'Loại tài khoản', []) !!}
            {!! Form::select('level', ['1'=>'Tài khoản thường','0'=>'Admin','2'=>'Tài khoản VIP'], isset($account) ? $account->level : '', ['class'=>'form-control']) !!}
          </div>
          @if(!isset($account))
          {!! Form::submit('Thêm', ['class'=>'btn btn-success']) !!}
          @else
          {!! Form::submit('Cập Nhật', ['class'=>'btn btn-success']) !!}
          @endif
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection