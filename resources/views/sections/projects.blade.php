<section class="relative z-10" id="projects">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Projecten'])
        <div class="">
            @foreach ($projects as $project)
                @include('components._project', [
                    $project,
                    'even' => $loop->even
                ])
            @endforeach
        </div>
    </div>
</section>
