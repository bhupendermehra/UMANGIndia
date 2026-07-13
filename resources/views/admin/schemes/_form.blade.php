@php
$scheme = $scheme ?? null;
@endphp

<div class="grid lg:grid-cols-2 gap-6">
    <!-- English Fields -->
    <div class="space-y-5">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">English Content</h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $scheme->title ?? '') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Short Description *</label>
                    <textarea name="short_description" rows="3" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('short_description', $scheme->short_description ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Brief 1-2 line summary shown in listings and search results.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Content (HTML) *</label>
                    <textarea name="content" rows="10" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-mono">{{ old('content', $scheme->content ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Full scheme details. Use basic HTML tags for formatting.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Eligibility</label>
                    <textarea name="eligibility" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('eligibility', $scheme->eligibility ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Who can apply. Separate points with new lines.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Benefits</label>
                    <textarea name="benefits" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('benefits', $scheme->benefits ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">What the applicant gets. Separate points with new lines.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Application Process</label>
                    <textarea name="application_process" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('application_process', $scheme->application_process ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Step-by-step how to apply. Each line = one step.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Required Documents (comma separated)</label>
                    <textarea name="required_documents" rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('required_documents', $scheme->required_documents ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Comma-separated list, e.g. Aadhaar Card, Income Certificate</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Hindi Fields + Meta -->
    <div class="space-y-5">
        <!-- Hindi Fields -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">हिंदी सामग्री (Hindi Content)</h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">शीर्षक (Title)</label>
                    <input type="text" name="title_hi" value="{{ old('title_hi', $scheme->title_hi ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Hindi title">
                    <p class="text-xs text-slate-500 mt-1">हिंदी में भरें (optional but recommended for Hindi users)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">संक्षिप्त विवरण (Short Description)</label>
                    <textarea name="short_description_hi" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Hindi short description">{{ old('short_description_hi', $scheme->short_description_hi ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">हिंदी में भरें (optional but recommended for Hindi users)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">विवरण (Content HTML)</label>
                    <textarea name="content_hi" rows="8"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-mono" placeholder="Hindi content (HTML)">{{ old('content_hi', $scheme->content_hi ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">हिंदी में भरें (optional but recommended for Hindi users)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">पात्रता (Eligibility)</label>
                    <textarea name="eligibility_hi" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Hindi eligibility">{{ old('eligibility_hi', $scheme->eligibility_hi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">लाभ (Benefits)</label>
                    <textarea name="benefits_hi" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Hindi benefits">{{ old('benefits_hi', $scheme->benefits_hi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">आवेदन प्रक्रिया (Application Process)</label>
                    <textarea name="application_process_hi" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Hindi application process">{{ old('application_process_hi', $scheme->application_process_hi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">आवश्यक दस्तावेज़ (Documents)</label>
                    <textarea name="required_documents_hi" rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Hindi documents">{{ old('required_documents_hi', $scheme->required_documents_hi ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Settings & Meta -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">Publishing &amp; Settings</h3>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                        <select name="category_id" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $scheme->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->icon }} {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-slate-500 mt-1">Pick the most relevant category for this scheme.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">State (null = Central)</label>
                        <select name="state_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">Central Government</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ old('state_id', $scheme->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-slate-500 mt-1">Leave empty for Central Government schemes.</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select name="status" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="active" {{ old('status', $scheme->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="upcoming" {{ old('status', $scheme->status ?? '') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="closed" {{ old('status', $scheme->status ?? '') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Application Deadline</label>
                        <input type="date" name="application_deadline" value="{{ old('application_deadline', $scheme->application_deadline ? $scheme->application_deadline->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 mt-1">Leave empty if no deadline or ongoing scheme.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Official Website</label>
                    <input type="url" name="official_website" value="{{ old('official_website', $scheme->official_website ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="https://">
                    <p class="text-xs text-slate-500 mt-1">Link to the official government portal for applications.</p>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $scheme->is_featured ?? false) ? 'checked' : '' }}
                        class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label class="text-sm text-gray-700">Featured Scheme</label>
                </div>
            </div>
        </div>

        <!-- SEO -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">SEO Meta</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $scheme->meta_title ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 mt-1">SEO title shown in search results. Keep under 60 characters.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title (Hindi)</label>
                    <input type="text" name="meta_title_hi" value="{{ old('meta_title_hi', $scheme->meta_title_hi ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('meta_description', $scheme->meta_description ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">SEO summary shown in search results. Keep under 160 characters.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description (Hindi)</label>
                    <textarea name="meta_description_hi" rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('meta_description_hi', $scheme->meta_description_hi ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $scheme->meta_keywords ?? '') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 mt-1">Comma-separated SEO keywords.</p>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
                {{ $submitText }}
            </button>
            <a href="{{ route('admin.schemes.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </div>
</div>
