@php
$category = $category ?? null;
@endphp

<div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 space-y-5">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name (English) *</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name (Hindi)</label>
            <input type="text" name="name_hi" value="{{ old('name_hi', $category->name_hi ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="हिंदी नाम">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug (auto-generated if empty)</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Icon (emoji)</label>
            <input type="text" name="icon" value="{{ old('icon', $category->icon ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="📚">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description (English)</label>
        <textarea name="description" rows="3"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description (Hindi)</label>
        <textarea name="description_hi" rows="3"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="हिंदी में विवरण">{{ old('description_hi', $category->description_hi ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $category->meta_description ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
            {{ $submitText }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">
            Cancel
        </a>
    </div>
</div>
