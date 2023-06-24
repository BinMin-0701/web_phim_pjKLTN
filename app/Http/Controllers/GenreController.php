<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $list = Genre::all();
    return view('admincp.genre.index', compact('list'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admincp.genre.form');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->validate(
      [
        'title' => 'required|unique:genres|max:255',
        'slug' => 'required',
        'description' => 'required|max:255',
        'status' => 'required',
      ],
      [
        'title.unique' => 'Thể loại này đã tồn tại!',
        'slug.required' => 'Slug trống',
        'title.required' => 'Tên Thể loại không được để trống',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $genre = new Genre();
    $genre->title = $data['title'];
    $genre->slug = $data['slug'];
    $genre->description = $data['description'];
    $genre->status = $data['status'];
    $genre->save();
    toastr()->success('Thêm thành công.', 'Thành công');
    return redirect()->route('genre.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $genre = Genre::find($id);
    $list = Genre::all();
    return view('admincp.genre.form', compact('list', 'genre'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->validate(
      [
        'title' => 'required|max:255',
        'slug' => 'required',
        'description' => 'required|max:255',
        'status' => 'required',
      ],
      [
        'title.unique' => 'Thể loại này đã tồn tại!',
        'Slug.required' => 'Slug trống',
        'title.required' => 'Tên Thể loại không được để trống',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $genre = Genre::find($id);
    $genre->title = $data['title'];
    $genre->slug = $data['slug'];
    $genre->description = $data['description'];
    $genre->status = $data['status'];
    $genre->save();
    toastr()->success('Cập nhật thành công.', 'Thành công');
    return redirect()->route('genre.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Genre::find($id)->delete();
    toastr()->success('Xóa thành công.', 'Thành công');
    return redirect()->back();
  }
}
