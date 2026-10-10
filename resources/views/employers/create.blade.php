@extends('layouts.app')

@section('content')
<a href="{{ route('dashboard') }}">@include('components._header', [$text = 'Create'])</a>
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Maak een nieuwe werkgever</h2>
            @if($errors->any())
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('employer.store') }}" method="POST">
                @csrf
                <div class="mb-3 w-full">
                    <label class="block" for="name">Naam</label>
                    <input class="text-black block w-full rounded-lg border-2 border-primary focus:border-secondary" type="text" name="name" id="name" placeholder="Naam" value="{{ old('name') }}">
                </div>
                <hr class="my-3 border-primary">
                <div class="mb-3 w-full">
                    <x-primary-button>Opslaan</x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
