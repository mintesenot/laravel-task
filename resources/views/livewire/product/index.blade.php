<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;


new
#[layout('layouts.app')]
#[Title('Product Created now')]
class extends Component {
    public function with()
    {
        return [
            'product' => Product::all(),
            'small' => Product::where('stock', '<', 5),
            'avg' => Product::avg('price')
        ];
    }

    public function delete(Product $delete)
    {
        $delete->delete();
    }
}; ?>

<div class="max-w-7xl mx-auto p-8" x-data="{ data: @js($product) }">
    <div class="grid grid-cols-3 gap-2">
        <div class="bg-white rounded-lg p-4 dark:bg-gray-800">
             <div>
                 <h3 class="text-2xl font-bold dark:text-white">All Product</h3>
                 <p class="text-gray-600">Here is the all created products.</p>
             </div>
             <div class="mt-4">
                <p class="text-4xl font-bold dark:text-white">{{ $product->count() }}</p>
             </div>
             <div class="flex justify-end items-center">
                 <a href="#" class="dark:text-white text-sm dark:hover:text-gray-200">Create New Product</a>
             </div>
        </div>
        <div class="bg-white rounded-lg p-4 dark:bg-gray-800">
            <div>
                <h3 class="text-2xl font-bold dark:text-white">Small Product</h3>
                <p class="text-gray-600">Here is the all Finished products.</p>
            </div>
            <div class="mt-4">
               <p class="text-4xl font-bold dark:text-white">{{ $small->count()  }}</p>
            </div>
       </div>
       <div class="bg-white rounded-lg p-4 dark:bg-gray-800">
        <div>
            <h3 class="text-2xl font-bold dark:text-white">Avarage Product</h3>
            <p class="text-gray-600">Here is the all Avarage products.</p>
        </div>
        <div class="mt-4">
           <p class="text-4xl font-bold dark:text-white">{{ Number::currency($avg, 'EUR') }}</p>
        </div>
   </div>
    </div>
   <div class="py-12">
    <div class="p-4 rounded bg-white dark:bg-gray-800">
    <livewire:product-table/>
    </div>
   </div>

</div>
