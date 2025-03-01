<div class="relative" wire:poll.15000ms>
    <div x-data="{ open: false }">
        <!-- Cart Button -->
        <button class="w-10 h-10 rounded-full shadow flex items-center justify-center" @click="open = !open">
            <div class="relative">
                <i class="bi bi-basket text-xl text-gray-500"></i>
                <span class="absolute w-5 h-5 text-sm bg-amber-200 text-black rounded-full">
                    {{ $cartItems->count() }}
                </span>
            </div>
        </button>

        <!-- Cart Dropdown -->
        <div x-show="open" x-transition class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 border border-gray-200 z-50">

            <!-- Header -->
            <div class="flex items-center justify-between pb-2">
                <h2 class="text-lg font-bold text-gray-700">Your Cart</h2>
                <i class="bi bi-x-circle text-gray-500 hover:text-red-700 text-lg cursor-pointer" @click="open = false"></i>
            </div>

            <!-- Cart Items -->
            <div class="divide-y divide-gray-200 max-h-60 overflow-y-auto">
                @forelse($cartItems as $item)
                <div class="py-2 flex items-center gap-4" wire:key="cart-item-{{ $item->id }}">
                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">

                    <div class="flex-1">
                        <h3 class="text-md font-semibold">{{ $item->product->name }}</h3>
                        <p class="text-gray-600">${{ number_format($item->total_price, 2) }}</p>

                        <!-- Quantity Control -->
                        <div class="flex items-center space-x-2 mt-1">
                            <button class="w-6 h-6 flex items-center justify-center shadow rounded-full text-gray-600 hover:bg-gray-200"
                                wire:click="decrementQuantity({{ $item->id }})">
                                <i class="bi bi-dash"></i>
                            </button>
                            <span class="font-semibold">{{ $item->quantity }}</span>
                            <button class="w-6 h-6 flex items-center justify-center shadow rounded-full text-gray-600 hover:bg-gray-200"
                                wire:click="incrementQuantity({{ $item->id }})">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remove Button -->
                    <button type="button" wire:click="removeFromCart({{ $item->id }})"
                        class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-500 rounded-full hover:bg-red-500 hover:text-white transition">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                @empty
                <!-- Empty Cart -->
                <div class="flex flex-col items-center py-4">
                    <i class="bi bi-x-lg text-gray-500 text-2xl"></i>
                    <p class="font-semibold text-gray-700 mt-2">Your cart is empty</p>
                </div>
                @endforelse
            </div>

            <!-- Checkout Button -->
            @if($cartItems->isNotEmpty())
            <div class="mt-4">
                <button class="w-full px-4 py-2 rounded-xl bg-blue-500 text-white font-semibold transition hover:bg-blue-600">
                    Checkout
                </button>
            </div>
            @endif
        </div>
    </div>
</div>


