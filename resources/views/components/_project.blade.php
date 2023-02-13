<div class="text pb-5 md:order-{{$order[0]}} order-{{$order[1]}}">
    <h2 class="text-xl text-[#E00496]">
        <span class="text-shadow-pink">
            {{$project->title}}
        </span>
        <span >
            <a href="{{ $project->site }}" class="text-xl hover:text-[#ff00aa]" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>
            @if (isset($project->github))
                <a href="{{ $project->github }}" class="text-xl hover:text-[#ff00aa]" target="_blank">
                    <i class="fa-brands fa-github"></i>
                </a>
            @endif
        </span>
    </h2>
    <p>{!! $project->text !!}</p>
</div>
<img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue md:order-{{$order[2]}} order-{{$order[3]}}" src="{{$project->image_path}}" alt="{{ $project->title }}">
