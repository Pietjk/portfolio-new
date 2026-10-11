@extends('layouts.app')

@section('content')
<a href="{{ route('dashboard') }}">@include('components._header', [$text = 'Edit'])</a>
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Bewerk hobbypost</h2>
            @if($errors->any())
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('hobbyPost.update', [$hobbyPost->getKey()]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                @include('hobby_posts._fields')
                <hr class="my-3 border-primary">
                <div class="mb-3 w-full">
                    <x-primary-button>Opslaan</x-primary-button>
                </div>
            </form>
            @if ($hobbyPost->image_path)
                <form id="delete-image-form" action="{{ route('hobbyPost.image.destroy', [$hobbyPost->getKey()]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            @endif
        </div>
    </div>
@endsection
