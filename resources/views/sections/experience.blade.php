<section id="experience">
    @include('components._header', [$text = 'Ervaring'])
    <div class="container mx-auto text-white max-w-[1024px] px-3 lg:px-10 pb-10 flex flex-col gap-10">
        @foreach ($employers as $employer)
                <div class="p-5 rounded-xl bg-[#170129] shadow-lg">
                <h2 class="text-2xl text-primary text-shadow-blue pb-4">{{ $employer->name }}</h2>
                <ol class="flex flex-col gap-6 ml-2">
                    @foreach ($employer->experiences as $experience)
                        <li class="relative pl-6 before:content-[''] before:absolute before:z-10 before:-left-2 before:top-1.5 before:h-4 before:w-4 before:rounded-full before:bg-secondary before:shadow-[0_0_10px_#E00496] after:content-[''] after:absolute after:-left-px after:top-3.5 after:-bottom-[38px] after:w-0.5 after:bg-secondary last:after:hidden">
                            <h3 class="text-xl">{{ $experience->function }}</h3>
                            <p class="text-sm opacity-75">
                                {{ $experience->start_date->locale('nl')->translatedFormat('F Y') }}
                                -
                                {{ $experience->end_date ? $experience->end_date->locale('nl')->translatedFormat('F Y') : 'heden' }}
                            </p>
                            @if ($experience->description)
                                <p class="pt-2">{!! $experience->description !!}</p>
                            @endif
                            @include('components._skill_pills', ['skills' => $experience->skills])
                        </li>
                    @endforeach
                </ol>
            </div>
        @endforeach
    </div>
</section>
