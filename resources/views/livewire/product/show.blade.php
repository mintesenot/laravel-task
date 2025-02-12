<?php

use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component {
    public function with(): array
    {
        return [
            'products' => Product::all(),
        ];
    }
}; ?>

 <!-- Product Grid -->
 <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
    <!-- Product Card -->
    @foreach($products as $row)
    <div :key="product.id">
      <div class="bg-white rounded-lg p-2 overflow-hidden">
        <img src="{{ asset('img/1.jpg') }}" :alt="product.name" class="w-full h-48 object-cover rounded-lg mb-4">
        <h3 class="text-lg font-semibold mb-2">{{ $row->name }}</h3>
        <p class="text-sm text-gray-600 mb-4">{{ $row->description }}</p>
        <div class="flex justify-between items-center">
          <span class="text-lg font-bold">{{ Number::currency($row->price, 'USD') }}</span>
          <button
            @click="addToCart(product)"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
          >
            ADD
          </button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
