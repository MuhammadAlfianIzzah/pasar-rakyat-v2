<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = CartFacade::getContent();
        return view('pages.cart', compact('cartItems'));
    }
    public function addToCart(Request $request, Produk $produk)
    {
        $attr = $request->validate([
            "quantity" => "required",
            "price" => "required"
        ]);

        CartFacade::add([
            'id' => $produk->id,
            'name' => $produk->nama,
            'price' => $attr["price"],
            'quantity' =>  $attr["quantity"],
            'attributes' => array(
                'image' => $produk->logos[0]->gambar,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');
        return redirect()->route('cart.list');
    }
    public function removeCart(Request $request, Produk $produk)
    {
        CartFacade::remove($produk->id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->route('cart.list');
    }
    public function clearAllCart()
    {
        CartFacade::clear();
        session()->flash('success', 'All Item Cart Clear Successfully !');
        return redirect()->route('cart.list');
    }
}
