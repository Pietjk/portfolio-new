<section id="projects-sm">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Kleine Projecten'])
        <div class="grid md:grid-cols-2 grid-cols-1 gap-x-5 px-10">
            @foreach ($projects_sm as $project)
                @include('components._project_small', [$project])
            @endforeach
        </div>

        <div class="px-10 py-5">
            <iframe class="w-full aspect-video image border-4 rounded-xl border-primary box-shadow-blue" src="https://www.youtube.com/embed/OAPPCnu2SRs" title="isle of greed showcase" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h2 class="text-xl text-secondary pt-3">
                <span class="text-shadow-pink">Isle of Greed</span>
                <span>
                    <a href="https://www.youtube.com/watch?v=OAPPCnu2SRs" class="text-xl hover:text-[#ff00aa]" target="_blank"  aria-label="youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://github.com/Pietjk/Isle_of_Greed" class="text-xl hover:text-[#ff00aa]" target="_blank" aria-label="github">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </span>
            </h2>
            <p>Deze <code>Unity/C#</code> game heb ik ontwikkeld in samenwerking met een vriend. Dit was het afsluitende schoolproject waardoor ik mijn eindstage mocht gaan doen.</p><p class="mt-5">De locaties van de eilanden en de sleutel fragmenten worden random gegenereerd. Met de fragmenten kan de speler een kist op het eiland openen voor een kristal. Met deze kristallen kan de speler upgrades kopen om sneller fragmenten te kunnen vinden.</p>
        </div>
    </div>

    <img class="pt-10 car" src="{{asset('images/car.png')}}" alt="" id="car">
    <div class="w-100 h-5 bg-secondary box-shadow-intense-pink" id="road"></div>
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

            // Add an offset to finish if site is too small
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
