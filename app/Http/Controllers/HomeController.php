<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Pre;
use App\Models\User;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pay_premium()
    {
        $user_id = Auth::user()->id;

        $new_payment = new Pre();
        $new_payment->user_id = $user_id;
        $new_payment->total = 500000; // Phần này chỉnh sửa lại để admin có thể chỉnh sửa được giá pre
        $new_payment->date = Carbon::now();
        $new_payment->save();
        $total = (float) $new_payment->total;

        $data_url = VNPay::vnpay_create_payment([
            'vnp_TxnRef' => $new_payment->id,
            'vnp_OrderInfo' => 'Thanh toán premium',
            'vnp_Amount' => $total,
        ]);
        return redirect()->to($data_url);
    }

    public function vnPayCheck(Request $request)
    {
        //01. Lấy data từ URL (do VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Mã phản hồi kết quả thanh toán. 00= thành công
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount'); //Số tiền thanh toán

        //02. Kiểm tra data, xem kết quả giáo dịch trả về từ VNPay hợp lệ không:
        if ($vnp_ResponseCode != null) {
            //Nếu kết quả thành công:
            if ($vnp_ResponseCode == 00) {
                //Cập nhật trạng thái User:
                $user = User::find(Auth::user()->id);
                $user->level = 2;
                $user->save();

                // //Gửi email:

                return redirect('pages/result')->with('notification', 'Bạn đã thanh toán thành công tài khoản premium.');
            } else {
                //Nếu không thành công
                //Xóa dữ liệu dã thêm vào database
                $payment = Pre::find($vnp_TxnRef);
                if ($payment) {
                    $payment->delete();
                }

                //Thông báo lỗi
                return redirect('pages/result')->with('notification', 'ERROR! Thanh toán không thành công hoặc bị hủy.');
            }
        }
    }

    public function result()
    {
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $category = Category::orderBy('position', 'ASC')->where('status', 1)->get();

        return view('pages.result', compact('genre', 'country', 'category'));
    }
}
