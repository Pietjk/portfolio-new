<section id="projects-sm">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Kleine Projecten'])
        <div class="grid md:grid-cols-2 grid-cols-1 gap-x-5 px-10">
            @foreach ($projects_sm as $project)
                @include('components._project_small', [$project])
            @endforeach
        </div>
    </div>
</section>
