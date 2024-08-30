<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid')->with('status', 'Login fail !');
    }
    public function registration()
    {
        return view('auth.registration');
    }
    public function customRegistration(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);


        //return $data;
        //return redirect("dashboard")->withSuccess('You have signed-in');
        return back()->with('status', 'Register is success ! You can login !');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'level' => 0,
            'password' => Hash::make($data['password'])
        ]);
    }
    public function dashboard()
    {
        if (Auth::check()) {

            $orders = Products::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
                ->whereYear('created_at', date('Y'))
                ->groupBy('created_at')
                ->pluck('count', 'month_name');

            $labels = $orders->keys();
            $data = $orders->values();

            ///
            $userCount = User::select(\DB::raw('COUNT(*) as countUser'))->get()[0]->countUser;
            $numberOrder = Order::select(\DB::raw('COUNT(*) as countOrder'))->get()[0]->countOrder;

            $numberOrderWeek = Products::select(\DB::raw('COUNT(*) as countPruct'))->get()[0]->countPruct;
            $sumEarningInMonth = Order::select(\DB::raw("sum(price_order) as totalMonthEarning"))->whereMonth('created_at',now()->month)->get()[0]->totalMonthEarning;

            if (Auth::user()->level > 0) {
                return view('admin.dasboard', compact('labels', 'data','userCount','numberOrder','numberOrderWeek','sumEarningInMonth'));
            } else {
                return redirect('/');
            }
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
