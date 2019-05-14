<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\ProductType;
use App\Cart;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $loai_sp = ProductType::all();
        // View::share('loai_sp', $loai_sp);
        //cách 2
        view()->composer('header',function($view){
            $loai_sp = ProductType::all();
            $view->with('loai_sp',$loai_sp);
        });

        view()->composer(['header','page.dathang'],function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with('cart',$cart);
                // $view->with(['cart'=>Session::get('cart'),'product_cart' =>$cart->items,'totalPrice' => $cart->totalPrice,'totalQty' => $cart->totalQty]);
                $view->with(['cart'=>Session::get('cart')]);
            }
        });
        
    }
}
