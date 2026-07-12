@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Site Settings</h1>
    <p class="text-gray-500 text-sm">Manage your site configuration</p>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')

    @foreach($settings as $group => $items)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="font-semibold text-gray-800 capitalize">{{ str_replace('_', ' ', $group) }}</h2>
        </div>
        <div class="p-5 space-y-4">
            @foreach($items as $setting)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ str_replace('_', ' ', ucfirst($setting->key)) }}
                </label>
                @if(in_array($setting->key, ['site_description', 'meta_description', 'meta_keywords']))
                    <textarea name="settings[{{ $setting->key }}]" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                @elseif($setting->key === 'adsense_enabled')
                    <select name="settings[{{ $setting->key }}]"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="0" {{ old("settings.{$setting->key}", $setting->value) == '0' ? 'selected' : '' }}>Disabled</option>
                        <option value="1" {{ old("settings.{$setting->key}", $setting->value) == '1' ? 'selected' : '' }}>Enabled</option>
                    </select>
                @else
                    <input type="text" name="settings[{{ $setting->key }}]"
                        value="{{ old("settings.{$setting->key}", $setting->value) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="{{ $setting->key }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="flex items-center gap-3 mb-8">
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
            Save All Settings
        </button>
    </div>
</form>
@endsection
