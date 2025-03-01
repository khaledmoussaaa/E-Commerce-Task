<div class="container mx-auto p-5" wire:poll.15000ms>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="p-4 space-y-3 mx-auto border border-gray-200 rounded-xl">
            <!-- Product Image -->
            <img src="{{ $product->image }}" class="w-full md:w-[350px] md:h-[300px] object-cover border border-gray-300 rounded-xl">

            <!-- Product Details -->
            <h3 class="text-lg font-semibold text-gray-700">{{ $product->name }}</h3>
            <p class="text-gray-500 font-medium">${{ number_format($product->price, 2) }}</p>

            <!-- Add to Cart Button with Dynamic Background -->
            <button class="w-full px-4 py-2 mt-2 flex items-center justify-center gap-2 border hover:bg-amber-300 border-gray-300 rounded-xl transition-all 
                {{ isset($cartItems[$product->id]) ? 'bg-amber-300' : ''}}"
                wire:click="addToCart({{ $product->id }})">
                <i class="bi bi-cart-plus"></i>
                <span class="font-medium">
                    {{ isset($cartItems[$product->id]) ? 'In Cart' : 'Add to Cart' }}
                </span>
            </button>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="py-4 sm:px-12">
        {{ $products->links() }}
    </div>
</div>