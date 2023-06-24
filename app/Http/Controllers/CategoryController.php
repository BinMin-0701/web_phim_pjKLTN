<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $list = Category::orderBy('position', 'ASC')->get();
    return view('admincp.category.index', compact('list'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admincp.category.form');
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
        'title' => 'required|unique:categories|max:255',
        'slug' => 'required',
        'description' => 'required|max:255',
        'status' => 'required',
      ],
      [
        'title.unique' => 'Danh mục này đã tồn tại!',
        'slug.required' => 'Đường dẫn trống!',
        'title.required' => 'Tên Danh mục không được để trống',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $category = new Category();
    $category->title = $data['title'];
    $category->slug = $data['slug'];
    $category->description = $data['description'];
    $category->status = $data['status'];
    $category->save();
    toastr()->success('Thêm Danh mục thành công.', 'Thành công');
    return redirect()->route('category.index');
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
    $category = Category::find($id);
    $list = Category::orderBy('position', 'ASC')->get();
    return view('admincp.category.form', compact('list', 'category'));
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
        'title.unique' => 'Danh mục này đã tồn tại!',
        'slug.required' => 'Đường dẫn trống!',
        'title.required' => 'Tên Danh mục không được để trống',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $category = Category::find($id);
    $category->title = $data['title'];
    $category->slug = $data['slug'];
    $category->description = $data['description'];
    $category->status = $data['status'];
    $category->save();
    toastr()->success('Cập nhật Danh mục thành công.', 'Thành công');
    return redirect()->route('category.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Category::find($id)->delete();
    toastr()->success('Xóa Danh mục thành công.', 'Thành công');
    return redirect()->back();
  }
  public function resorting(Request  $request)
  {
    $data = $request->all();

    foreach ($data['array_id'] as $key => $value) {
      $category = Category::find($value);
      $category->position = $key;
      $category->save();
    }
  }
}
