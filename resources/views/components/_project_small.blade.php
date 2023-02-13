<div class="p-3">
    <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue" src="{{ asset($project->image_path) }}" alt="{{ $project->title }}">
    <h2 class="text-xl text-[#E00496] text-shadow-pink pt-3">{{ $project->title }}</h2>
    <p>{!! $project->text !!}</p>
</div>
