<x-layouts.app :title="('Edit new Product Category')">
    <flux:heading>Edit new Product Categories</flux:heading>
    <flux:subheading>Form untuk menambah product categori baru</flux:subheading>
    <flux:separator variant="subtle"/>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <flux:input name="name" label="Name" value="{{ $category->name }}" placeholder="Product Category Name" required/>
        <flux:input name="slug" label="Slug" value="{{ $category->slug }}" placeholder="Product Category Slug" required/>
        
        <flux:textarea name="description" label="Description" placeholder="Product Category Description" required>
            {{ $category->description }}
        </flux:textarea>

        @if($category->image)
            <div class="mb-3">
                <img src="{{ Storage::url($category->image) }}" 
                alt="{{ $category->name }}" 
                class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        <flux:input name="image" type="file" label="Image" placeholder="Product Image" />
        <flux:button type="submit" icon="plus" variant="primary" class="mt-4 mb-4">Simpan</flux:button>
    </form>
</x-layouts.app>