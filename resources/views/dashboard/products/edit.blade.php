<x-layouts.app :title="('Edit Product')">
    <flux:heading>Edit Product</flux:heading>
    <flux:subheading>Form untuk mengubah data produk yang sudah ada</flux:subheading>
    <flux:separator variant="subtle" />

    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <flux:input name="name" label="Name" value="{{ old('name', $product->name) }}" required />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <flux:input name="price" label="Price" type="number" value="{{ old('price', $product->price) }}" step="0.01" min="0" required />
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <flux:input name="stock" label="Stock" type="number" value="{{ old('stock', $product->stock) }}" min="0" required />
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <flux:select name="product_category_id" label="Category" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </flux:select>
                @error('product_category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="space-y-2">
            <flux:textarea name="description" label="Description" rows="4" placeholder="Product description here..." required>
                {{ old('description', $product->description) }}
            </flux:textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('dashboard.products.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition duration-200">
                Cancel
            </a>
            <flux:button type="submit" icon="plus" variant="primary">Update</flux:button>
        </div>
    </form>
</x-layouts.app>