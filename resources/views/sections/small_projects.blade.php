<section id="projects-sm">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Kleine Projecten'])
        <div class="grid md:grid-cols-2 grid-cols-1 gap-x-5 px-10">
            @foreach ($projects_sm as $project)
                @include('components._project_small', [$project])
            @endforeach
        </div>
    </div>
    <img class="pt-10 car" src="{{asset('images/car.png')}}" alt="" id="car">
    <div class="w-100 h-5 bg-[#E00496] box-shadow-intense-pink" id="road"></div>
</section>
@push('scripts')
    <script>
        window.addEventListener("scroll", movePercentage);

        function movePercentage() {
            const road = document.getElementById('road');
            const car = document.getElementById('car');

            const windowHeight = window.innerHeight;
            const start = road.offsetTop - (windowHeight);
            let finish = road.offsetTop;
            const scrollPos = (document.body.getBoundingClientRect()).top;
            const remainingSiteHeight = document.body.scrollHeight - finish;

            // Add an offset to finish if site is to small
            if (remainingSiteHeight < windowHeight) {
                finish -= (windowHeight - remainingSiteHeight);
            }

            const onePercent = (finish - start) / 100;
            const offset = 894

            // When car is visible move it by the scroll position percentage
            if (scrollPos * -1 >= start && scrollPos * -1 <= finish) {
                let percentage = (scrollPos * -1 - start) / onePercent;
                let carPos = ((window.innerWidth + offset) / 100) * percentage;

                car.style.transform = "translateX("+ (carPos - offset) +"px)";
            }
        }
    </script>
@endpush
