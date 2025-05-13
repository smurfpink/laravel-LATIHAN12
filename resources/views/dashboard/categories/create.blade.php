<x-layouts.app :title="('Create new Product Category')">
    <flux:heading>Create new Product Categories</flux:heading>
    <flux:subheading>Form untuk menambah product categori baru</flux:subheading>
    <flux:separator variant="subtle"/>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <flux:input name="name" label="Name" placeholder="Product Category Name" required/>
        <flux:input name="slug" label="Slug" placeholder="Product Category Slug" required/>
        <flux:textarea name="description" label="Description" placeholder="Product Category Description" required/>
        <flux:input name="image" type="file" label="Image" placeholder="Product Category Image" />
        <flux:button type="submit" icon="plus" varian="primary" class="mt-4 mb-4">Simpan</flux:button>
    </form>

</x-layouts.app>