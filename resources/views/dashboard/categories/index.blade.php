<x-layouts.app :title="__('Categories')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Categories</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('categories.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ request('q') }}" placeholder="Search Categories" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('categories.create') }}" variant="subtle">Add New Category</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session('successMessage') }}</flux:badge>
    @endif

    <table class="min-w-full leading-normal text-black">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Slug</th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td class="px-5 py-5 border-b bg-white text-sm">{{ $category->id }}</td>
                    <td class="px-5 py-5 border-b bg-white text-sm">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b bg-white text-sm">{{ $category->name }}</td>
                    <td class="px-5 py-5 border-b bg-white text-sm">{{ $category->slug }}</td>
                    <td class="px-5 py-5 border-b bg-white text-sm">{{ $category->description }}</td>
                    <td class="px-5 py-5 border-b bg-white text-sm">{{ $category->created_at->format('Y-m-d') }}</td>
                    <td class="px-5 py-5 border-b bg-white text-sm">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-5 border-b bg-white text-sm text-center">
                        No categories found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.app>