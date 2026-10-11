<section id="hobbies">
    @include('components._header', [$text = "Hobby's"])
    <div class="container mx-auto text-white max-w-[1024px] px-10 pb-10" x-data="{ active: {{ $hobbies->first()?->id ?? 'null' }}, modal: null }" @keydown.escape.window="modal = null">
        <div class="rounded-3xl shadow-2xl p-10 bg-[#170129]">
            <div class="flex flex-wrap gap-3 mb-12">
                @foreach ($hobbies as $hobby)
                    <button type="button"
                        class="flex items-center gap-2 px-5 py-2 rounded-full border-2 border-secondary transition-colors"
                        :class="active === {{ $hobby->id }} ? 'bg-secondary text-white' : 'text-secondary hover:bg-secondary/20'"
                        @click="active = {{ $hobby->id }}">
                        @if ($hobby->image_path)
                            <img class="h-5 w-5 object-contain" src="{{ asset($hobby->image_path) }}" alt="">
                        @elseif ($hobby->icon)
                            <i class="{{ $hobby->icon }}"></i>
                        @endif
                        {{ $hobby->name }}
                    </button>
                @endforeach
            </div>

            @forelse ($hobbies as $hobby)
                <div x-show="active === {{ $hobby->id }}" x-cloak
                    x-data="{
                        index: 0,
                        perView: 1,
                        total: {{ $hobby->hobbyPosts->count() }},
                        get maxIndex() { return Math.max(0, this.total - this.perView); },
                        init() {
                            const update = () => {
                                this.perView = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
                                this.index = Math.min(this.index, this.maxIndex);
                            };
                            update();
                            window.addEventListener('resize', update);
                        },
                    }">
                    <div class="mb-8 flex flex-col items-start gap-4">
                        <p>{{ $hobby->description }}</p>
                        @if ($hobby->link)
                            <a href="{{ $hobby->link }}" target="_blank" rel="noopener noreferrer"
                                class="px-5 py-2 rounded-full border-2 border-secondary text-secondary hover:bg-secondary hover:text-white transition-colors">Bekijk meer</a>
                        @endif
                    </div>

                    @if ($hobby->hobbyPosts->isEmpty())
                        <p class="text-center">Nog geen berichten bij deze hobby.</p>
                    @else
                        <div class="flex items-center gap-3">
                            <button type="button" aria-label="Vorige"
                                class="shrink-0 flex items-center justify-center h-12 w-12 rounded-full border-2 border-secondary text-secondary transition-colors hover:bg-secondary hover:text-white disabled:opacity-30 disabled:pointer-events-none"
                                :disabled="index === 0" @click="index = Math.max(0, index - 1)">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <div class="overflow-hidden grow">
                                <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${index * (100 / perView)}%)`">
                                    @foreach ($hobby->hobbyPosts as $post)
                                        <div class="px-2 shrink-0" :style="`flex-basis: ${100 / perView}%`">
                                            <div role="button" tabindex="0"
                                                class="h-full flex flex-col rounded-xl overflow-hidden border-4 border-primary box-shadow-blue cursor-pointer text-left"
                                                @click="modal = {{ $post->id }}" @keydown.enter="modal = {{ $post->id }}">
                                                @if ($post->image_path)
                                                    <img class="w-full aspect-video object-cover" src="{{ asset($post->image_path) }}" alt="{{ $post->name }}">
                                                @else
                                                    <div class="w-full aspect-video flex items-center justify-center bg-gradient-to-br from-[#170129] to-secondary/50 text-secondary text-4xl">
                                                        <i class="{{ $hobby->icon ?: 'fa-regular fa-image' }}"></i>
                                                    </div>
                                                @endif
                                                <div class="flex flex-col gap-3 grow p-4">
                                                    <h3 class="text-xl text-primary">{{ $post->name }}</h3>
                                                    @if ($post->description)
                                                        <p class="line-clamp-3">{{ html_entity_decode(strip_tags($post->description)) }}</p>
                                                    @endif
                                                    @if ($post->link)
                                                        <a href="{{ $post->link }}" target="_blank" rel="noopener noreferrer" @click.stop
                                                            class="mt-auto self-start px-4 py-1 rounded-full border-2 border-secondary text-secondary hover:bg-secondary hover:text-white transition-colors">Bekijk meer</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="button" aria-label="Volgende"
                                class="shrink-0 flex items-center justify-center h-12 w-12 rounded-full border-2 border-secondary text-secondary transition-colors hover:bg-secondary hover:text-white disabled:opacity-30 disabled:pointer-events-none"
                                :disabled="index >= maxIndex" @click="index = Math.min(maxIndex, index + 1)">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-center">Nog geen hobby's.</p>
            @endforelse
        </div>

        @foreach ($hobbies as $hobby)
            @foreach ($hobby->hobbyPosts as $post)
                <div x-show="modal === {{ $post->id }}" x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                    @click.self="modal = null" role="dialog" aria-modal="true" aria-label="{{ $post->name }}">
                    <div class="relative w-full max-w-5xl max-h-full overflow-y-auto rounded-3xl bg-[#170129] border-4 border-primary box-shadow-blue">
                        <button type="button" aria-label="Sluiten"
                            class="absolute top-3 right-3 z-10 flex items-center justify-center h-10 w-10 rounded-full bg-black/60 text-white hover:bg-secondary transition-colors"
                            @click="modal = null">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        @if ($post->image_path)
                            <img class="w-full max-h-[65vh] object-contain bg-black" src="{{ asset($post->image_path) }}" alt="{{ $post->name }}">
                        @endif
                        <div class="flex flex-col gap-4 p-6">
                            <h3 class="text-3xl text-primary">{{ $post->name }}</h3>
                            @if ($post->description)
                                <div class="hobby-description">{!! $post->description !!}</div>
                            @endif
                            @if ($post->link)
                                <a href="{{ $post->link }}" target="_blank" rel="noopener noreferrer"
                                    class="self-start px-5 py-2 rounded-full border-2 border-secondary text-secondary hover:bg-secondary hover:text-white transition-colors">Bekijk meer</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</section>
