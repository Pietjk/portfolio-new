<div class="p-3">
    <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue" src="{{ asset($project->image_path) }}" alt="{{ $project->title }}">
    <h2 class="text-xl text-[#E00496] text-shadow-pink pt-3">
        <span>{{ $project->title }}</span>
        <span >
            @if (isset($project->site))
                <a href="{{ $project->site }}" class="text-xl hover:text-[#ff00aa]" target="_blank"  aria-label="{{ $project->site }}">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            @endif
            @if (isset($project->github))
                <a href="{{ $project->github }}" class="text-xl hover:text-[#ff00aa]" target="_blank" aria-label="github">
                    <i class="fa-brands fa-github"></i>
                </a>
            @endif
        </span>
    </h2>
    <p>{!! $project->text !!}</p>
</div>
