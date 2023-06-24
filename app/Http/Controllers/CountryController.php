<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $list = Country::all();
    return view('admincp.country.index', compact('list'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admincp.country.form');
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
        'title' => 'required|unique:countries|max:255',
        'slug' => 'required',
        'description' => 'required|max:255',
        'status' => 'required',
      ],
      [
        'title.unique' => 'Quốc gia này đã tồn tại!',
        'slug.required' => 'Đường dẫn trống!',
        'title.required' => 'Tên Quốc gia không được để trống',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $country = new Country();
    $country->title = $data['title'];
    $country->slug = $data['slug'];
    $country->description = $data['description'];
    $country->status = $data['status'];
    $country->save();
    toastr()->success('Thêm Quốc gia thành công.', 'Thành công');
    return redirect()->route('country.index');
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
    $country = Country::find($id);
    $list = Country::all();
    return view('admincp.country.form', compact('list', 'country'));
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
        'slug.required' => 'Đường dẫn trống!',
        'title.required' => 'Tên Quốc gia không được để trống',
        'description.required' => 'Mô tả không được bỏ trống',
      ]
    );
    $country = Country::find($id);
    $country->title = $data['title'];
    $country->slug = $data['title'];
    $country->description = $data['description'];
    $country->status = $data['status'];
    $country->save();
    toastr()->success('Cập nhật Quốc gia thành công.', 'Thành công');
    return redirect()->route('country.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Country::find($id)->delete();
    toastr()->success('Xóa nhật Quốc gia thành công.', 'Thành công');
    return redirect()->back();
  }
}
