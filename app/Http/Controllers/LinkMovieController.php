<?php

namespace App\Http\Controllers;

use App\Models\LinkMovie;
use Illuminate\Http\Request;

class LinkMovieController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $linkmovie = LinkMovie::orderBy('id', 'DESC')->get();
    return view('admincp.linkmovie.index', compact('linkmovie'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admincp.linkmovie.form');
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
        'title'=> 'required|unique:linkmovie|max:255',
        'description' => 'required|max:255',
        'status' => 'required',
      ],
      [
        'title.unique' => 'Link này đã tồn tại!',
        'title.required' => 'Link chưa nhập',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $category = new LinkMovie();
    $category->title = $data['title'];
    $category->description = $data['description'];
    $category->status = $data['status'];
    $category->save();
    // toastr()->success('Thành công','Thêm link phim thành công.');
    return redirect()->route('linkmovie.index');
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
    $linkmovie = LinkMovie::find($id);
    return view('admincp.linkmovie.form',compact('linkmovie'));
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
        'title' => 'required|unique:linkmovie|max:255',
        'description' => 'required|max:255',
        'status' => 'required',
      ],
      [
        'title.unique' => 'Link này đã tồn tại!',
        'title.required' => 'Link chưa nhập',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $category = LinkMovie::find($id);
    $category->title = $data['title'];
    $category->description = $data['description'];
    $category->status = $data['status'];
    $category->save();
    // toastr()->success('Thành công','Thêm link phim thành công.');
    return redirect()->route('linkmovie.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    LinkMovie::find($id)->delete();
    return redirect()->back();
  }
}
