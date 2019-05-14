<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Session;
use Hash,Mail;

class PageController extends Controller
{
    //Home
    function getIndex(){
    	$slide = Slide::all();
        $new_product = Product::where('new',1)->paginate(4);
    	$promotion_product = Product::where('promotion_price','<>',0)->paginate(8);
    	return view('page.trangchu',['slide' => $slide,'new_product' =>$new_product,'promotion_product' => $promotion_product]);
    }
    //Products
    function getLoaiSP($id){
         $loai_sp = ProductType::all();
         $id_loaisp = $id;
         $new_product = Product::where('id_type',$id)->where('new',1)->paginate(4);
         $promotion_product = Product::where('id_type',$id)->where('promotion_price','<>',0)->paginate(4);
         $tenloaisp = ProductType::where('id',$id)->first();
    	return view('page.loai_sanpham',['loai_sp' => $loai_sp,'id_loaisp' =>$id_loaisp,'new_product' =>$new_product,'promotion_product' => $promotion_product,'tenloaisp' => $tenloaisp]);
    }
    //Product Detail
    function getChiTietSP($id){
        $sanpham = Product::where('id',$id)->first();
        $sanpham_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6);
    	return view('page.chitiet_sanpham',['sanpham' => $sanpham,'sanpham_tuongtu' =>$sanpham_tuongtu]);
    }

    //Contact
    function getLienHe(){
    	return view('page.lienhe');
    }

    function postLienHe(Request $request){
        $data = ['hoten' => $request->subject, 'tinnhan' => $request->message];
        Mail::send('page.blanks',$data, function ($msg){
            $msg->from('thanhhoang317@gmail.com','HoangSon');
            $msg->to('hoangsonle211@gmail.com','LeSon')->subject('Đây là mail');
        });
        echo "<script>
            alert('Cám ơn đã góm ý');
            window.location = ('".url('index')."');

        </script>";
    }

    //Introduce
    function getGioiThieu(){
    	return view('page.gioithieu');
    }


    //Cart Code
    function getAddtoCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    function getDelCart(Request $request, $id){
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            $request->session()->put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }
        return redirect()->back();

    }
    function getCheckout(){
        
        return view('page.dathang');
    }
    function postCheckout(Request $request){
        // $this->validate($request,
        //     [
        //         'name'       =>'required',
        //         'phone'       =>'required',
        //         'address'       =>'required',
        //         'email'     =>'required|email', 
        //     ],

        //     [
        //         'name.required'              =>'Bạn chưa nhập tên',
        //         'phone.required'              =>'Bạn chưa nhập số điện thoại',
        //         'address.required'              =>'Bạn chưa nhập địa chỉ',
        //         'email.required'            =>'Bạn chưa nhập Email',
        //         'email.email'               =>'Bạn chưa nhập đúng định dạng Email',

        //     ]);
        //đã kiểm tra bên html
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone;
        if($request->notes!= null)
            $customer->note = $request->notes;
        else 
            $customer->note = null;
        $customer->save();

        $bill = new Bill;
        $bill->id = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->payment_method;
        $bill->note = $request->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $billdetail = new BillDetail;
            $billdetail->id_bill = $bill->id;
            $billdetail->id_product = $key;
            $billdetail->quantity = $value['qty'];
            $billdetail->unit_price = $value['price']/$value['qty'];
            $billdetail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');
    }


    //Login , Logout, Registry
    function getLogin(){
        if(Auth::check())
            return redirect('index');
        return view('page.dangnhap');
    }
    function postLogin(Request $request){

        // $this->validate($request,
        //     [
        //         'email'     =>'email', 
        //         'password'  =>'required|min:3|max:32',
        //     ],

        //     [
        //         'email.email'               =>'Bạn chưa nhập đúng định dạng Email',
        //         'password.required'         =>'Bạn chưa nhập password',
        //         'password.min'              =>'Mật khẩu phải có ít nhất 3 ký tự',
        //         'password.max'              =>'Mật khẩu chỉ có nhiều nhất 32 ký tự',

        //     ]);
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('index');
        }
        else{
            return redirect()->back()->with('thongbao','Đăng nhập không thành công');

        }
    }

    function getRegistry(){
        return view('page.dangky');
    }
    function postRegistry(Request $request){
        $this->validate($request,
            [
                'name'       =>'required',
                'email'     =>'required|email|unique:users,email', 
                'password'  =>'required|min:3|max:32',
                'passwordAgain' =>'required|same:password',
            ],

            [
                'name.required'             =>'Bạn chưa nhập tên',
                'email.email'               =>'Bạn chưa nhập đúng định dạng Email',
                'email.unique'              =>'Email đã tồn tại',
                'password.required'         =>'Bạn chưa nhập password',
                'password.min'              =>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'              =>'Mật khẩu chỉ có nhiều nhất 32 ký tự',
                'passwordAgain.required'    =>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'        =>'Mật khẩu nhập lại chưa đúng',

            ]);
        $user = new User;
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($request->phone!= null)
            $user->phone = $request->phone;
        else 
            $user->phone = null;
        if($request->address!= null)
            $user->address = $request->address;
        else 
            $user->address = null;

        $user->save();
        return redirect()->back()->with('thongbao','Đã đăng ký thành công');
    }

    function getLogout(){
        Auth::logout();
        return redirect('index');
    }

    //Search
    function getSearch(Request $request){
        $keyword = $request->keyword;
        $product = Product::where('name','like',"%$keyword%")->orWhere('unit_price',$keyword)->paginate(8);
        return view('page.timkiem',['products' => $product]);
    }
}
