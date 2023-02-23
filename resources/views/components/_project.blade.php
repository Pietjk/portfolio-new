<div class="grid md:grid-cols-2 grid-cols-1 gap-y-5 gap-x-10 px-10 py-5 projects">
    <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue @if(!$even) md:order-2 @endif" src="{{$project->image_path}}" alt="{{ $project->title }}">
    <div class="text pb-5 @if(!$even) md:order-1 @endif">
        <h2 class="text-xl text-[#E00496]">
            <span class="text-shadow-pink">
                {{$project->title}}
            </span>
            <span >
                <a href="{{ $project->site }}" class="text-xl hover:text-[#ff00aa]" target="_blank"  aria-label="{{ $project->site }}">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
                @if (isset($project->github))
                    <a href="{{ $project->github }}" class="text-xl hover:text-[#ff00aa]" target="_blank" aria-label="github">
                        <i class="fa-brands fa-github"></i>
                    </a>
                @endif
            </span>
        </h2>
        <p>{!! $project->text !!}</p>
    </div>
</div>