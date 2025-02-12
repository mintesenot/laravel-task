<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\OrderItem;

new class extends Component {
    public function with(): array
    {
        $month = 10; // October
        $year = 2023; // Year
        return [
            'users' =>  OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product') // Eager load the product details
            ->limit(10) // Top 10 best-selling products
            ->get()
        ];
    }
}; ?>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="flex border-b justify-between items-center p-4 dark:border-gray-600">
        <p class="text-lg font-semibold dark:text-white text-gray-600">Monthly Selling Product </p>
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-gray-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 dark:border-gray-800 border-gray-200 shadow-md rounded-lg p-2">
          <thead>
            <tr class="bg-white dark:bg-gray-800 text-left text-sm font-semibold dark:text-gray-200 text-gray-700">
              <th class="py-3 px-4 border-b">Product Name</th>
              <th class="py-3 px-4 border-b">Price</th>
              <th class="py-3 px-4 border-b">Stock</th>
              <th class="py-3 px-4 border-b">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $row)
            <tr class="text-sm text-gray-700">
                <td class="py-3 px-4 border-b">{{ $row->name}}</td>
                <td class="py-3 px-4 border-b">{{ $row->total_amount}}</td>
                <td class="py-3 px-4 border-b">{{ $row->stock}}</td>
                <td class="py-3 px-4 border-b">
                  <button class="text-blue-500 hover:text-blue-700">Edit</button>
                  <button class="text-red-500 hover:text-red-700">Delete</button>
                </td>
              </tr>
            @endforeach

            <!-- Add more rows here as needed -->
          </tbody>
        </table>
      </div>

</div>
