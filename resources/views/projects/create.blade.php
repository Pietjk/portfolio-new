@extends('layouts.app')

@section('content')
<a href="{{ route('dashboard') }}">@include('components._header', [$text = 'Create'])</a>
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-[#E00496] text-shadow-pink pb-5 text-center">Maak een nieuw project</h2>
            @if($errors->any())
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('project.store') }}" method="POST" enctype= multipart/form-data>
                @csrf
                <input type="hidden" name="is_small" value="{{ $is_small }}">
                <div class="mb-3 w-full">
                    <label class="block" for="title">Titel</label>
                    <input class="text-black block w-full rounded-lg border-2 border-[#09aac0] focus:border-[#E00496]" type="text" name="title" id="title" placeholder="Titel" value="{{ old('title') }}">
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="title">Text</label>
                    <textarea class="text-black block w-full rounded-lg border-2 border-[#09aac0] focus:border-[#E00496] p-2" name="text" id="text" rows="3" placeholder="Text">{{ old('text') }}</textarea>
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="site">Site</label>
                    <input class="text-black block w-full rounded-lg border-2 border-[#09aac0] focus:border-[#E00496]" type="text" name="site" id="site" placeholder="Site" value="{{ old('site') }}">
                </div>
                <div class="mb-3 w-full">
                    <label class="block" for="github">Github</label>
                    <input class="text-black block w-full rounded-lg border-2 border-[#09aac0] focus:border-[#E00496]" type="text" name="github" id="github" placeholder="Github" value="{{ old('github') }}">
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
                <hr class="my-3 border-[#09aac0]">
                <div class="mb-3 w-full">
                    <x-primary-button>Opslaan</x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
