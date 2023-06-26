@extends('layout')
@section('content')
<div class="row container" id="wrapper">
  <div class="halim-panel-filter text-center">
    <h1>Thông tin tài khoản</h1>
  </div>

  <div class="accout-form" style="padding: 0 2rem;">
    <form>
      <div class="form-group">
        <label for="exampleFormControlInput1">Tên người dùng</label>
        <input type="email" style="background: transparent; color: #fff;" class="form-control " id="exampleFormControlInput1" placeholder="{{ Auth::user()->name }}" readonly>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput2">Email</label>
        <input type="email" style="background: transparent; color: #fff;" class="form-control " id="exampleFormControlInput2" placeholder="{{ Auth::user()->email }}" readonly>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput3">Tình trạng</label>
        <input type="email" style="background: transparent; color: #fff;" class="form-control " id="exampleFormControlInput3" placeholder="@if (Auth::user()->level == 1) Thành viên thường @elseif (Auth::user()->level == 0) Admin @else Thành viên Vip @endif" readonly>
      </div>
    </form>
  </div>

  <div class="button-upgrade-vip" style="padding: 0 2rem;">
    @if (Auth::user()->level == 1)
    <form action="/pay_premium" method="post">
      @csrf
      <p>Để xem phim có phí, hãy nâng lên Thành viên Vip</p>
      <button type="submit" class="btn btn-success">Nâng cấp tài khoản</button>
    </form>
    @endif
  </div>
</div>
@endsection