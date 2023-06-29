@extends('layouts.app')

@section('content')

<table class="table" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên Người dùng</th>
      <th scope="col">Email đăng nhập</th>
      <th scope="col" style="text-align: center;">Trạng thái tài khoản</th>
      <th scope="col" style="text-align: center;">Quản lý</th>
    </tr>
  </thead>
  <tbody class="order_position">
    @foreach($account as $key => $account)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$account->name}}</td>
      <td>{{$account->email}}</td>
      <td style="text-align: center;">
        @if($account->level == 0)
        Admin
        @elseif($account->level == 1)
        Thường
        @else
        Vip
        @endif
      </td>
      <td>
        <div style="display: flex; gap: .25rem; justify-content: center;">
          {!! Form::open(['method'=>'DELETE','route'=>['account.destroy',$account->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
          {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
          {!! Form::close() !!}
          <a href="{{route('account.edit',$account->id)}}" class="btn btn-warning">Sửa</a>

        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection