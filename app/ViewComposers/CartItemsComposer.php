<?php
namespace App\ViewComposers;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class CartItemsComposer {

    public $cart;

    public function __construct()
    {
        $this->cart = Session::has('cart') ? Session::get('cart') : null;
    }

    public function compose(View $view)
    {
        $currency = '₦';
        $view->with('carts', ($this->cart))->with('currency', $currency);
    }



}

