<section id="skills">
    @include('components._header', [$text = 'Vaardigheden'])
    <div class="container mx-auto text-white max-w-[1024px] px-10" x-data="{ active: {{ $categories->first()?->id ?? 'null' }} }">
        <div class="rounded-3xl shadow-2xl p-10 bg-[#170129]">
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
            @foreach ($categories as $category)
                <ul class="p-5 rounded-xl  box-shadow-blue border-primary border-4 flex flex-col gap-5 px-14" x-show="active === {{ $category->id }}" x-cloak>
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
            @if ($categories->count() > 1)
                <div class="items-end justify-end hidden md:flex">
                <button type="button" aria-label="Volgende categorie"
                    class="group flex items-center justify-center h-32 w-32 sm:h-40 sm:w-40 rounded-full border-4 border-secondary bg-gradient-to-br from-[#170129] to-secondary/50 text-secondary shadow-[0_0_20px_#E00496,inset_0_0_20px_rgba(224,4,150,0.5)] transition-all duration-300 hover:scale-105 hover:bg-secondary hover:text-white hover:shadow-[0_0_40px_#E00496,0_0_80px_#E00496] active:scale-95"
                    @click="active = {{ $categories->pluck('id')->toJson() }}[({{ $categories->pluck('id')->toJson() }}.indexOf(active) + 1) % {{ $categories->count() }}]">
                    <i class="fa-solid fa-arrow-right text-6xl sm:text-7xl text-shadow-pink transition-transform duration-300 group-hover:translate-x-2"></i>
                </button>
                </div>
            @endif
            </div>
        </div>
    </div>
</section>
