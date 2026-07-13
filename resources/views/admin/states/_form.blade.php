@php
$state = $state ?? null;
@endphp

<div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 space-y-5">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name (English) *</label>
            <input type="text" name="name" value="{{ old('name', $state->name ?? '') }}" required
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name (Hindi)</label>
            <input type="text" name="name_hi" value="{{ old('name_hi', $state->name_hi ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="हिंदी में नाम">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug (auto-generated if empty)</label>
            <input type="text" name="slug" value="{{ old('slug', $state->slug ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div class="flex items-end pb-1">
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_central" value="1" {{ old('is_central', $state->is_central ?? false) ? 'checked' : '' }}
                    class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                <label class="text-sm text-gray-700">Central Government</label>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Intro</label>
            <textarea name="short_intro" rows="2"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="1-2 sentence summary shown under the state name">{{ old('short_intro', $state->short_intro ?? '') }}</textarea>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="8"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-mono"
                placeholder="Full HTML editorial overview of schemes in this state">{{ old('description', $state->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
            <input type="text" name="featured_image" value="{{ old('featured_image', $state->featured_image ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="https://... banner image URL">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $state->meta_title ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $state->meta_description ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
            {{ $submitText }}
        </button>
        <a href="{{ route('admin.states.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">
            Cancel
        </a>
    </div>
</div>
