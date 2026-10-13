<section id="skills">
    @include('components._header', [$text = 'Skills'])
    <div class="container mx-auto text-white max-w-[1024px] px-3 lg:px-10" x-data="{ active: {{ $categories->first()?->id ?? 'null' }} }">
            <div class="rounded-3xl shadow-2xl p-5 sm:p-10 bg-[#170129]">
            <div class="flex flex-wrap gap-3 mb-12">
                @foreach ($categories as $category)
                    <button type="button"
                        class="flex items-center gap-2 px-5 py-2 rounded-full border-2 border-secondary transition-colors"
                        :class="active === {{ $category->id }} ? 'bg-secondary text-white' : 'text-secondary hover:bg-secondary/20'"
                        @click="active = {{ $category->id }}">
                        @if ($category->image_path)
                            <img class="h-5 w-5 object-contain" src="{{ asset($category->image_path) }}" alt="">
                        @elseif ($category->icon)
                            <i class="{{ $category->icon }}"></i>
                        @endif
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            @foreach ($categories as $category)
                <ul class="space-y-5" x-show="active === {{ $category->id }}" x-cloak>
                    @forelse ($category->skills as $skill)
                        <li class="flex items-center gap-3">
                            @if ($skill->image_path)
                                <img class="h-6 w-6 object-contain" src="{{ asset($skill->image_path) }}" alt="">
                            @elseif ($skill->icon)
                                <i class="{{ $skill->icon }} w-6 text-center text-primary"></i>
                            @endif
                            <span>{{ $skill->name }}</span>
                        </li>
                        <div class="w-full h-[1px] bg-white @if ($loop->last) hidden @endif"></div>
                    @empty
                        <li class="text-center">Nog geen vaardigheden in deze categorie.</li>
                    @endforelse
                </ul>
            @endforeach
        </div>
    </div>
</section>
