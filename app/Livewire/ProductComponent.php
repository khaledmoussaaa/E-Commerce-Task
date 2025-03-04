<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductComponent extends Component
{
    use WithPagination;

    /**
     * Stores cart items as an associative array [product_id => quantity].
     *
     * @var array
     */
    public $cartItems = [];

    /**
     * Listen for cart updates and reload cart items.
     *
     * @var array
     */
    protected $listeners = ['cartUpdated' => 'loadCart'];

    /**
     * Loads the cart data initially..
     * 
     */
    public function mount()
    {
        $this->loadCart();
    }

    /**
     * Fetches cart items for the authenticated or guest user.
     * Uses eager loading and plucks only necessary data for better performance.
     */
    public function loadCart()
    {
        $this->cartItems = Cart::where(function ($query) {
            if (Auth::check()) {
                $query->where('user_id', get_authId());
            } else {
                $query->where('session_id', get_sessionId());
            }
        })->pluck('quantity', 'product_id')->toArray();
    }

    /**
     * Adds a product to the cart, ensuring session-based present.
     * If the product exists in the cart, the quantity is incremented.
     *
     * @param int $productId
     */
    public function addToCart(int $productId): void
    {
        $product = Product::findOrFail($productId);
        if ($product) {
            Cart::updateOrCreate(
                [
                    'user_id' => get_authId(),
                    'session_id' => get_sessionId(),
                    'product_id' => $product->id,
                    'total_price' => $product->price,
                ]
            );
            $this->dispatch('cartUpdated');
        }
    }

    /**
     * Renders the product listing with pagination.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.product-component', [
            'products' => Product::paginate(20),
        ]);
    }
}
