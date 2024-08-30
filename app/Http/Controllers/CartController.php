<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Order;
use App\Models\Voucher_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function cartList()
    {

        $userId = auth()->user()->id;

        $cartItems = \Cart::getContent();
        $cartInDB  = CartModel::where('users_id', $userId)->get();

        //set data in db == data in cart



        return view('cart', ['cartItems' => $cartItems, 'cartInDB' => $cartInDB]);

        // }
        //else => show in DB

        //


        // return back();
    }
    public function addToCart(Request $request)
    {
        $userId = auth()->user()->id;

        \Cart::session($userId)->add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price * $request->quantity,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
                'price' => $request->price
            )
        ]);
        // add to DB

        CartModel::create([
            'name' => $request->name,
            'products_id' => $request->id,
            'c_price' => $request->price * $request->quantity,
            'quantity' => $request->quantity,
            'users_id' => $userId,
            'attributes' => array(
                'image' => $request->image,
                'price' => $request->price
            )
        ]);


        //
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }
    public function addToCartAjax(Request $request)
    {
        $userId = auth()->user()->id;


        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price * $request->quantity,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
                'price' => $request->price
            )
        ]);
        // add to DB

        $cartDB = CartModel::create([
            'name' => $request->name,
            'products_id' => $request->id,
            'c_price' => $request->price * $request->quantity,
            'quantity' => $request->quantity,
            'users_id' => $userId,
            'attributes' => array(
                'image' => $request->image,
                'price' => $request->price
            )
        ]);


        //
        return response()->json([
            'result' => $request->all(),
            'cart' =>
            [
                'total' => \Cart::getTotal(),
                'totalPrice' => \Cart::getTotalQuantity()
            ]
        ]);
    }
    public function updateItemCart(Request $request)
    {
        $userId = auth()->user()->id;
        if ($request->quantity == 0) {
            \Cart::remove($request->id);
            CartModel::where('users_id', $userId)->where('id', $request->id)->delete();
        } else {
            // \Cart::remove($request->id);
            \Cart::update($request->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            ));
            $prdPrice = CartModel::find($request->id)->products->price;
            CartModel::where('users_id', $userId)->where('id', $request->id)->update([
                'quantity' => $request->quantity,
                'c_price' => $request->quantity *  $prdPrice
            ]);
        }

        return $request->all();
    }
    public function removeCart(Request $request)
    {
        $userId = auth()->user()->id;

        \Cart::remove($request->id);
        //remove in DB

        CartModel::where('users_id', $userId)->where('id', $request->id)->delete();

        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }
    public function clearAllCart()
    {
        $userId = auth()->user()->id;
        \Cart::clear();

        CartModel::where('users_id', $userId)->delete();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
    public function checkout(Request $request)
    {
        $userId = auth()->user()->id;
        $cart  = CartModel::where('users_id', $userId)->get();
        //check voucher_code
        $price_order=$request->price_order;
        $discount = 0;
        if (isset($request->voucher_code)) {
            // re-caculate price_order - TESTCODE
            $voucher = Voucher_code::where('code',$request->voucher_code)->first();
            if($voucher){
                $discountVal = $voucher->discount;
                $discount = ($request->price_order * $discountVal) / 100;
                //re-caculate price
                $price_order =  $request->price_order - ( ($request->price_order * $discountVal) / 100);
                return view('checkout', ['products' => $cart, 'fee' => $request->fee, 'price_order' => $price_order, 'discount'=>$discount,'status'=>"Applied !"]);
            }else{
                return view('checkout', ['products' => $cart, 'fee' => $request->fee, 'price_order' => $price_order,'discount'=>$discount,'status'=>"Voucher is not found !"]);
            }
        }

        //return $request->all()

        return view('checkout', ['products' => $cart, 'fee' => $request->fee, 'price_order' => $price_order,'discount'=>$discount]);
    }
    public function pay(Request $request)
    {


        return $request->all();
    }
    public function onepay_payment(Request $request)
    {

        //check voucher code



        // *********************
        // START OF MAIN PROGRAM
        // *********************

        // Define Constants
        // ----------------
        // To not create a secure hash, let SECURE_SECRET be an empty string - ""
        // $SECURE_SECRET = "secure-hash-secret";
        // Khóa bí mật - được cấp bởi OnePAY
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";

        // add the start of the vpcURL querystring parameters
        // *****************************Lấy giá trị url cổng thanh toán*****************************
        // $vpcURL = $_POST["virtualPaymentClientURL"] . "?"; https://mtf.onepay.vn/onecomm-pay/vpc.op
        $vpcURL = "https://mtf.onepay.vn/onecomm-pay/vpc.op" . "?";
        // Remove the Virtual Payment Client URL from the parameter hash as we 
        // do not want to send these fields to the Virtual Payment Client.
        // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
        // unset($_POST["virtualPaymentClientURL"]);
        // unset($_POST["SubButL"]);

        $vpc_Merchant = 'ONEPAY';
        $vpc_AccessCode = 'D67342C2';
        $vpc_MerchTxnRef = date('YmdHis') . rand();;
        $vpc_OrderInfo = 'JSECURETEST01';
        $vpc_Amount = $request->total_pay;
        $vpc_ReturnURL = 'http://shop.test/payment-status';
        $vpc_Version = '2';
        $vpc_Command = 'pay';
        $vpc_Locale = 'vn';
        $vpc_Currency = 'VND';

        $data = array(
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_OrderInfo' => $vpc_OrderInfo,
            'vpc_Amount' => $vpc_Amount,
            'vpc_ReturnURL' => $vpc_ReturnURL,
            'vpc_Version' => $vpc_Version,
            'vpc_Command' => $vpc_Command,
            'vpc_Locale' => $vpc_Locale,
            'vpc_Currency' => $vpc_Currency
        );
        //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
        $stringHashData = "";
        // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
        // arrange array data a-z before make a hash
        ksort($data);

        // set a parameter to show the first pair in the URL
        // đặt tham số đếm = 0
        $appendAmp = 0;

        foreach ($data as $key => $value) {

            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }
        //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
        $stringHashData = rtrim($stringHashData, "&");
        // Create the secure hash and append it to the Virtual Payment Client Data if
        // the merchant secret has been provided.
        // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
        if (strlen($SECURE_SECRET) > 0) {
            //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
            // *****************************Thay hàm mã hóa dữ liệu*****************************
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)));
        }

        // FINISH TRANSACTION - Redirect the customers using the Digital Order
        // ===================================================================
        // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
        // header("Location: " . $vpcURL);




        return redirect()->to($vpcURL);
        // *******************
        // END OF MAIN PROGRAM
        // *******************


    }
    public function vnpay_payment(Request $request)
    {
        // error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        // date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://shop.test/payment-status";
        $vnp_TmnCode = "5L8U7UAW"; //Mã website tại VNPAY 
        $vnp_HashSecret = "OHPTKKWMECFFJYQHKMJBYVNYVLFXQGFZ"; //Chuỗi bí mật

        // $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_TxnRef = rand(0,999999);
        $vnp_OrderInfo = "Noi dung thanh toán đơn hàng " . $vnp_TxnRef;
        $vnp_OrderType = "Billpayment";
        $vnp_Amount = $request->total_pay * 100;
        $vnp_Locale = 'vn';
        //$vnp_BankCode = 'VNPAYQR';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        //Add Params of 2.0.1 Version
  
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            
            //"vnp_Bill_voucherPr"=> $vnp_voucherPr,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
            
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
    public function payment_status(Request $request)
    {
        $statusCode = $request->vnp_ResponseCode;
        $userId = auth()->user()->id;
        $status = "";
        //save order to db
        if($statusCode==24 || $statusCode == 15) {
            // huy thanh toan
            $status = "Thanh toán không thành công .";
        }else if($statusCode=="00"){
            $status = "Thanh toán thành công .";
        }
        Order::create([
            'users_id'=>$userId,
            'price_order'=> $request->vnp_Amount,
            'status'=>$status,    
        ]);

        //remove cart
        if($statusCode=="00"){
            CartModel::where('users_id',$userId)->delete();
        }
        
        //vnp_CardType=ATM
        //vnp_OrderInfo
        //vnp_Amount
        //vnp_BankCode
        //vnp_PayDate
        //vnp_ResponseCode
        //vnp_TransactionNo
        //vnp_TransactionStatus

        //return $request->all();

        return view('vertify-payment',['statusCode'=>$statusCode]);
    }
}
