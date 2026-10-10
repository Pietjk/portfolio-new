@if ($skills->isNotEmpty())
    <ul class="flex flex-wrap gap-2 pt-3">
        @foreach ($skills->take(3) as $skill)
            <li class="px-3 py-1 rounded-full border-2 border-secondary text-secondary text-sm">{{ $skill->name }}</li>
        @endforeach
    </ul>
@endif
