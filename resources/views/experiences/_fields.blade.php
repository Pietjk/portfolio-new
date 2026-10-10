<div class="mb-3 w-full">
    <label class="block" for="employer_id">Werkgever</label>
    <select class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" name="employer_id" id="employer_id">
        @foreach ($employers as $employer)
            <option value="{{ $employer->id }}" @selected((old('employer_id') ?? $experience?->employer_id) == $employer->id)>{{ $employer->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3 w-full">
    <label class="block" for="function">Functie</label>
    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="function" id="function" placeholder="Functie" value="{{ old('function') ?? $experience?->function }}">
</div>
<div class="mb-3 w-full">
    <label class="block" for="description">Beschrijving</label>
    <textarea class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" name="description" id="description" rows="4" placeholder="Beschrijving">{{ old('description') ?? $experience?->description }}</textarea>
</div>
@php
    $isCurrent = session()->hasOldInput() ? (bool) old('is_current') : ($experience && $experience->isCurrent());
@endphp
<div class="mb-3 w-full" x-data="{ current: {{ $isCurrent ? 'true' : 'false' }} }">
    <div class="mb-3 w-full">
        <label class="block" for="start_date">Startdatum</label>
        <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="date" name="start_date" id="start_date" value="{{ old('start_date') ?? $experience?->start_date->format('Y-m-d') }}">
    </div>
    <div class="mb-3 w-full">
        <label class="block" for="end_date">Einddatum</label>
        <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary disabled:opacity-50" type="date" name="end_date" id="end_date" value="{{ old('end_date') ?? $experience?->end_date?->format('Y-m-d') }}" :disabled="current">
    </div>
    <label class="flex items-center gap-2">
        <input type="checkbox" name="is_current" value="1" x-model="current">
        Nog werkzaam (heden)
    </label>
</div>
@include('components._skill_picker', ['selected' => $experience?->skills->pluck('id')->all() ?? []])
