@extends('layouts.app')

@section('content')
<section id="project-details">
    @include('components._header', [$text = $project->title])
    <div class="container mx-auto text-white max-w-[1024px] px-10">
        <div class="grid grid-cols-3 text-center gap-y-2 py-3">
            <div class="overflow-visible">
                <h2 class="text-secondary text-shadow-pink text-xl pb-2">Terug</h2>
                <h2 class="text-secondary text-xl  transition-transform hover:scale-150 w-fit mx-auto">
                    <a href="{{ route('home') }}#projects" aria-label="Terug naar Home">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </h2>
            </div>
            <div class="overflow-visible">
                <h2 class="text-secondary text-shadow-pink text-xl pb-2">Github</h2>
                <h2 class="text-secondary text-xl  transition-transform hover:scale-150 w-fit mx-auto">
                    <a href="{{ $project->github_link }}" target="_blank" aria-label="Github">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </h2>
            </div>
            <div class="overflow-visible">
                <h2 class="text-secondary text-shadow-pink text-xl pb-2">Link</h2>
                <h2 class="text-secondary text-xl  transition-transform hover:scale-150 w-fit mx-auto">
                    <a href="{{ $project->link }}" target="_blank" aria-label="Project Link">
                        <i class="fa-solid fa-link"></i>
                    </a>
                </h2>
            </div>
        </div>
    </div>
    <div class="container mx-auto text-white max-w-[1024px] px-10">
        <div class="mx-auto w-full py-5">
            <img class="image border-4 rounded-xl border-primary box-shadow-blue w-full" src="{{ asset($project->image_path) }}" alt="{{ $project->title }}">
        </div>
        @foreach ($projectDetails as $detail)
             <div class="w-full px-10 py-5">
                 <div class="md:col-span-2 md:order-1 order-2">
                     <h2 class="text-primary text-shadow-blue text-2xl">{{ $detail->title }}</h2>
                     @if (isset($detail->subtitle))
                     <h3 class="text-secondary text-shadow-pink text-xl">{{ $detail->subtitle }}</h3>
                     @endif
                     <p>{!! $detail->text !!}</p>
                     @if (isset($detail->image_path))
                     <div class="w-full py-5">
                         <img class="image border-4 rounded-xl border-primary box-shadow-blue" src="{{ asset($detail->image_path) }}" alt="{{ $detail->title }}">
                     </div>
                     @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@include('sections.footer')
@endsection

