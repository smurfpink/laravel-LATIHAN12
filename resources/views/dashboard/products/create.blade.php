<x-layouts.app :title="('Add New Product')">
    <flux:heading>Add New Product</flux:heading>
    <flux:subheading>Form untuk menambahkan produk baru ke dalam sistem</flux:subheading>
    <flux:separator variant="subtle" />

    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
        @csrf

        <flux:input name="name" label="Name" placeholder="Product Name" value="{{ old('name') }}" required />

        <flux:textarea name="description" label="Description" placeholder="Product Description" required>
            {{ old('description') }}
        </flux:textarea>

        <flux:select name="product_category_id" label="Category" required>
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>

        <flux:input name="price" label="Price" type="number" value="{{ old('price') }}" step="0.01" min="0" placeholder="0.00" required />

        <flux:input name="stock" label="Stock" type="number" value="{{ old('stock') }}" min="0" placeholder="0" required />

        <flux:input name="image" label="Image" type="file" placeholder="Upload Product Image" />

        <div class="flex justify-end space-x-4">
            <a href="{{ route('dashboard.products.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition duration-200">
                Cancel
            </a>
            <flux:button type="submit" icon="plus" variant="primary">Save</flux:button>
        </div>
    </form>
</x-layouts.app>