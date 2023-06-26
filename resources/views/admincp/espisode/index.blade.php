@extends('layouts.app')

@section('content')

<table class="table" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên phim</th>
      <th scope="col">Ảnh phim</th>
      <th scope="col">Tập</th>
      <th scope="col">Đường dẫn phim</th>
      <!-- <th scope="col">Trạng thái</th> -->
      <th scope="col">Quản lý</th>
    </tr>
  </thead>
  <tbody class="order_position">
    @foreach($list_episode as $key => $episode)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$episode->movie->title}}</td>
      <td><img width="100" src="{{asset('uploads/movie/'.$episode->movie->image)}}"></td>
      <td>{{$episode->episode}}</td>
      <td>{{$episode->linkphim}}</td>
      <!-- <td>
        @if($episode->status)
          Hiển thị
          @else
          Không hiển thị
          @endif
      </td> -->
      <td style="min-width: 135px;">
        {!! Form::open(['method'=>'DELETE','route'=>['episode.destroy',$episode->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")','style'=>'display: inline-block;']) !!}
        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}
        <a href="{{route('episode.edit',$episode->id)}}" class="btn btn-warning">Sửa</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection