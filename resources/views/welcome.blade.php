<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-neutral-100">
          <div class="container mx-auto p-4" x-data="productListing">
            <!-- Categories -->
            <div class="flex gap-4 overflow-y-scroll mb-8">
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Vegetables & Fruits</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Dairy & Breakfast</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Munchies</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Cold Drinks & Juices</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Instant & Frozen Food</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Tea, Coffee & Health Drinks</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">Bakery & Biscuits</button>
              <button class="px-4 py-2 bg-white rounded-lg shadow-md hover:bg-gray-100">More</button>
            </div>

           <livewire:product.show />

          </div>

          <script>
            document.addEventListener('alpine:init', () => {
              Alpine.data('productListing', () => ({
                products: [
                  {
                    id: 1,
                    name: 'Perfect Rolling Paper with Filter',
                    description: '3 pack',
                    price: 120,
                    image: 'https://via.placeholder.com/150',
                  },
                  {
                    id: 2,
                    name: 'Ultimate Rolling Paper with Filter',
                    description: '1 pack (64 pieces)',
                    price: 90,
                    image: 'https://via.placeholder.com/150',
                  },
                  {
                    id: 3,
                    name: 'Brown Ripper Rolling Paper 32',
                    description: '1 pack (32 pieces)',
                    price: 45,
                    image: 'https://via.placeholder.com/150',
                  },
                  {
                    id: 4,
                    name: 'Tips & Crushing Tray (King Size)',
                    description: '3 pack',
                    price: 80,
                    image: 'https://via.placeholder.com/150',
                  },
                ],

                addToCart(product) {
                  alert(`Added ${product.name} to cart!`);
                  // You can add logic here to update a cart state or send data to a backend.
                },
              }));
            });
          </script>
    </body>
</html>
