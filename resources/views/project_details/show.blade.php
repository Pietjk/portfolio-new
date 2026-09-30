@extends('layouts.app')

@section('content')
<section id="project-details">
    @include('components._header', [$text = $project->title])
    <div class="container mx-auto text-white max-w-[1024px] px-10">
        <a href="{{ route('home') }}#projects" class="inline-block mb-5 hover:text-[#ff00aa]">
            <i class="fa-solid fa-arrow-left"></i> Terug naar projecten
        </a>
        @if (isset($projectDetailHeader))
            <div class="grid md:grid-cols-3 gap-x-5 items-center mb-5">
                <div class="md:col-span-2 md:order-1 order-2">
                    <h2 class="text-primary text-shadow-blue text-2xl">{{ $projectDetailHeader->title }}</h2>
                    <p>{!! $projectDetailHeader->text !!}</p>
                </div>
                <div class="px-3 pb-5 md:p-5 md:order-2 order-1">
                    <img class="image border-4 rounded-xl border-primary box-shadow-blue" src="{{ asset($projectDetailHeader->image_path) }}" alt="{{ $projectDetailHeader->title }}">
                </div>
            </div>
        @endif
        @each('components._project_detail_paragraph', $projectDetails, 'projectDetail')
    </div>
</section>
@include('sections.footer')
@endsection

