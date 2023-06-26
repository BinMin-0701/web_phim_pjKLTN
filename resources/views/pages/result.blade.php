@extends('layout')
@section('content')
<div class="row container" id="wrapper">
  <div class="halim-panel-filter text-center">
    <h1>
      @if(session('notification'))
      {{ session('notification') ?? 'Chưa có giao dịch nào!' }}
      @endif
    </h1>
  </div>
</div>
@endsection