<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    /**
     * Listen for cart updates and reload cart items.
     *
     * @var array
     */
    protected $listeners = ['cartUpdated' => 'render'];

    /**
     * Remove an item from the cart and trigger a UI update.
     * Ensures that only existing items are deleted.
     *
     * @param int $cartId
     * @return void
     */
    public function removeFromCart(int $cartId): void
    {
        if ($cartItem = Cart::find($cartId)) {
            $cartItem->delete();
            $this->dispatch('cartUpdated');
        }
    }

    /**
     * Increase the quantity of a cart item and update UI.
     *
     * @param int $cartId
     * @return void
     */
    public function incrementQuantity(int $cartId): void
    {
        if ($cartItem = Cart::find($cartId)) {
            $cartItem->increment('quantity');
            $cartItem->update([
                'total_price' => $cartItem->quantity * $cartItem->product->price
            ]);
            $this->dispatch('cartUpdated');
        }
    }

    /**
     * Decrease the quantity of a cart item, ensuring it doesn't go below 1.
     * If quantity reaches 0, the item is removed.
     *
     * @param int $cartId
     * @return void
     */
    public function decrementQuantity(int $cartId): void
    {
        if ($cartItem = Cart::find($cartId)) {
            $cartItem->quantity > 1 ? $cartItem->decrement('quantity') : $cartItem->delete();
            $this->dispatch('cartUpdated');
        }
    }

    /**
     * Retrieve cart items for the authenticated or guest user.
     * Uses eager loading to optimize database queries.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $cartItems = Cart::with('product')->when(Auth::check(), function ($query) {
            return $query->where('user_id', get_authId());
        }, function ($query) {
            return $query->where('session_id', get_sessionId());
        })->get();

        return view('livewire.cart-component', compact('cartItems'));
    }
}
