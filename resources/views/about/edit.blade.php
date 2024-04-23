@extends('layouts.app')

@section('content')
    <a href="{{ route('dashboard') }}">@include('components._header', [$text = 'Edit'])</a>
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Maak een nieuw about</h2>
            @if($errors->any())
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('aboutText.update', [$aboutText->getKey()]) }}" method="POST" enctype= multipart/form-data>
                @method('PATCH')
                @csrf
                <div class="mb-3 w-full">
                    <label class="block" for="title">Titel</label>
                    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="title" id="title" placeholder="Titel" value="{{ old('title') ?? $aboutText->title }}">
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="subtitle">Subtitel</label>
                    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="subtitle" id="subtitle" placeholder="subtitel" value="{{ old('subtitle') ?? $aboutText->subtitle }}">
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="title">Text</label>
                    <textarea class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary p-2" name="text" id="text" rows="3" placeholder="Text">{{ old('text') ?? $aboutText->text }}</textarea>
                </div>
                <div class="mb-3 w-full">
                    <label for="image_path" class="block">Afbeelding</label>
                    <label>
                        <input type="file" id="image_path" name="image_path" class="text-sm text-grey-500
                            file:mr-5 file:py-2 file:px-6
                            file:rounded-md file:border-0
                            file:text-sm file:font-medium
                            file:bg-white file:text-black
                            hover:file:cursor-pointer
                            hover:file:bg-gray-100
                      " />
                    </label>
                </div>
                <hr class="my-3 border-primary">
                <div class="mb-3 w-full">
                    <x-primary-button>Opslaan</x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
