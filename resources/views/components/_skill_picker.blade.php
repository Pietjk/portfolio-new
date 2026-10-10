@php
    $selected = collect(old('skills', $selected ?? []))->map(fn ($id) => (int) $id)->all();
@endphp
<div class="mb-3 w-full">
    <span class="block">Vaardigheden</span>
    <div class="flex flex-wrap gap-2 pt-1">
        @forelse ($skills as $skill)
            <label class="cursor-pointer">
                <input class="peer sr-only" type="checkbox" name="skills[]" value="{{ $skill->id }}" @checked(in_array($skill->id, $selected, true))>
                <span class="inline-block px-3 py-1 rounded-full border-2 border-secondary text-secondary text-sm transition-colors peer-checked:bg-secondary peer-checked:text-white peer-focus-visible:ring-2">
                    {{ $skill->name }}
                </span>
            </label>
        @empty
            <span class="text-sm">Nog geen vaardigheden beschikbaar.</span>
        @endforelse
    </div>
</div>
