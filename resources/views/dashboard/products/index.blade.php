<x-layouts.app :title="__('Products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Products</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Products</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('dashboard.products.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ request('q') }}" placeholder="Search Products" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('dashboard.products.create') }}" variant="subtle">Add New Product</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('success'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session('success') }}</flux:badge>
    @endif

    <table class="min-w-full leading-normal text-black">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    ID
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Image
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Name
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Category
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Description
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Created At
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $product->id }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $product->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $product->category ? $product->category->name : '-' }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $product->description }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $product->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        No products found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.app>