<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $account = User::orderBy('id', 'DESC')->get();
    return view('admincp.account.index', compact('account'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admincp.account.form');
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
        'name' => 'required|max:255',
        'email' => 'required|unique:users|email|max:255',
        'password' => 'required',
        'level' => '',
      ],
      [
        'email.unique' => 'Email này đã tồn tại!',
        'email.required' => 'Email không được để trống!',
        'name.required' => 'Tên người dùng không được để trống!',
        'password.required' => 'Mật khẩu không được để trống!',
      ]
    );
    $account = new User();
    $account->name = $data['name'];
    $account->email = $data['email'];
    $account->password = bcrypt($request->input('password'));
    $account->level = $data['level'];
    $account->save();
    toastr()->success('Thêm tài khoản mới thành công.', 'Thành công');
    return redirect()->route('account.index');
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
    $account = User::find($id);
    return view('admincp.account.form', compact('account'));
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
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => '',
        'level' => '',
      ],
      [
        'email.required' => 'Email không được để trống!',
        'name.required' => 'Tên người dùng không được để trống!',
        // 'password.required' => 'Mật khẩu không được để trống!',
      ]
    );
    $account = User::find($id);
    $account->name = $data['name'];
    $account->email = $data['email'];
    $account->password = bcrypt($request->input('password'));
    $account->level = $data['level'];
    $account->save();
    toastr()->success('Cập nhật tài khoản thành công.', 'Thành công');
    return redirect()->route('account.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::find($id)->delete();
    toastr()->success('Xóa thành công.', 'Thành công');
    return redirect()->back();
  }

  function updateLevel($conn)
  {
    $sql = "UPDATE User SET level = 1 WHERE level = 2";
    if ($conn->query($sql) === TRUE) {
      echo "Cập nhật level thành công.";
    } else {
      echo "Lỗi khi cập nhật level: " . $conn->error;
    }
  }
}
