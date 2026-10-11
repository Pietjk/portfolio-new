@php($hobbyPost ??= null)
<div class="mb-3 w-full">
    <label class="block" for="hobby_id">Hobby</label>
    <select class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" name="hobby_id" id="hobby_id">
        @foreach ($hobbies as $hobby)
            <option value="{{ $hobby->id }}" @selected((old('hobby_id') ?? $hobbyPost?->hobby_id) == $hobby->id)>{{ $hobby->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3 w-full">
    <label class="block" for="name">Naam</label>
    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="name" id="name" placeholder="Naam" value="{{ old('name') ?? $hobbyPost?->name }}">
</div>
<div class="mb-3 w-full">
    <label class="block" for="description">Beschrijving (HTML toegestaan)</label>
    <textarea class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" name="description" id="description" rows="6" placeholder="Beschrijving">{{ old('description') ?? $hobbyPost?->description }}</textarea>
</div>
<div class="mb-3 w-full">
    <label class="block" for="link">Link</label>
    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="url" name="link" id="link" placeholder="https://" value="{{ old('link') ?? $hobbyPost?->link }}">
</div>
<div class="mb-3 w-full">
    <label for="image_path" class="block">Afbeelding</label>
    @if ($hobbyPost?->image_path)
        <img class="h-16 mb-2" src="{{ asset($hobbyPost->image_path) }}" alt="{{ $hobbyPost->name }}">
        <button type="submit" form="delete-image-form" class="mb-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md" onclick="return confirm('Afbeelding verwijderen?')">Afbeelding verwijderen</button>
    @endif
    <input type="file" id="image_path" name="image_path" class="text-sm text-grey-500 file:mr-5 file:py-2 file:px-6 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-white file:text-black hover:file:cursor-pointer hover:file:bg-gray-100" />
</div>
