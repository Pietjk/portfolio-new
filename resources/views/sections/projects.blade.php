<section class="relative z-10" id="projects">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Projecten'])
        <div class="grid md:grid-cols-2 grid-cols-1 gap-y-5 gap-x-10 px-10 py-5 projects">
            @foreach ($projects as $project)
                @includeIf('components._project', [
                    $project = $project,
                    $order = App\Helpers\General::createOrder($loop->even, $loop->index)
                ])
            @endforeach
        </div>
    </div>
</section>
