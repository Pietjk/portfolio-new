@extends('layouts.app')

@section('content')
<a href="{{ route('dashboard') }}">@include('components._header', [$text = 'Edit'])</a>
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Bewerk vaardigheid</h2>
            @if($errors->any())
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('skill.update', [$skill->getKey()]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="mb-3 w-full">
                    <label class="block" for="name">Naam</label>
                    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="name" id="name" placeholder="Naam" value="{{ old('name') ?? $skill->name }}">
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="category_id">Categorie</label>
                    <select class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((old('category_id') ?? $skill->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="icon">Icoon (bijv. fa-solid fa-house)</label>
                    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="icon" id="icon" placeholder="fa-solid fa-house" value="{{ old('icon') ?? $skill->icon }}">
                </div>
                <div class="mb-3 w-full">
                    <label for="image_path" class="block">Afbeelding</label>
                    @if ($skill->image_path)
                        <img class="h-16 mb-2" src="{{ asset($skill->image_path) }}" alt="{{ $skill->name }}">
                                                <button type="submit" form="delete-image-form" class="mb-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md" onclick="return confirm('Afbeelding verwijderen?')">Afbeelding verwijderen</button>                    @endif
                    <input type="file" id="image_path" name="image_path" class="text-sm text-grey-500 file:mr-5 file:py-2 file:px-6 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-white file:text-black hover:file:cursor-pointer hover:file:bg-gray-100" />
                </div>
                <hr class="my-3 border-primary">
                <div class="mb-3 w-full">
                    <x-primary-button>Opslaan</x-primary-button>
                </div>
            </form>
            @if ($skill->image_path)
                <form id="delete-image-form" action="{{ route('skill.image.destroy', [$skill->getKey()]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            @endif
        </div>
    </div>
@endsection
