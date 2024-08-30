<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\CartModel;
use App\Models\Categories;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();
        //
        $categories = Categories::all();
        View::share('categories', $categories);
        $settings = Setting::all()->first();
        View::share('setting', $settings);
        ///
        // cart
        $totalcart = 0;
        $totalQuantity = 0;
        $totalCartItem = null;
        if (Auth::check()) {
            $totalcart = CartModel::where('users_id', auth()->user()->id)->count();

            $totalQuantity = \Cart::getTotal();
            $totalCartItem = \Cart::getTotalQuantity();
        }
        // $cart;
        View::share('totalCart', $totalcart);

        View::share('totalQuantity', $totalQuantity);
        View::share('totalCartItem', $totalCartItem);

        $cartInDB = CartModel::all();

        View::share('cartInDB', $totalCartItem);
        $totalcartDB = 0;
        foreach ($cartInDB as $item) {
            $totalcartDB += $item->c_price;
        }

        View::share('totalcartDB', $totalcartDB);
        View::share('totalQuantityDB', count($cartInDB));
    }
}
