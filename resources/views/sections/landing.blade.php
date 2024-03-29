<section class="min-h-screen bg-gradient-to-b from-slate-900 via-violet-900 to-indigo-600 w-full overflow-hidden landing" id="landing">
    <div class="landing-noise">
        <a href="#" class="logo" id="sun-img">
            <img class="z-10 absolute -bottom-5" src="{{ asset('/images/piet_logo_grain.png') }}" alt="Piet jouke Korfmaker">
        </a>
        <a href="#" class="sun overflow-visible" id="sun" aria-label="scroll down"><div class="landing-noise-2 h-full w-full rounded-full"></div></a>

        <div class="grid-container grid grid-cols-12">
            @for ($i = 0; $i < 117; $i++)
                <div class="grid-line"></div>
            @endfor
        </div>
    </div>
</section>
@push('scripts')
    <script>
        document.getElementById('sun-img').addEventListener('click', sunExplodes);
        document.getElementById('sun').addEventListener('click', sunExplodes);

        function sunExplodes() {
            let sun = document.getElementById('sun')
            let img = document.getElementById('sun-img')
            console.log(img);
            sun.classList.toggle('explode');
            sun.children[0].classList.toggle('landing-noise-2');
            sun.classList.toggle('z-20');
            img.classList.toggle('hidden');

            setTimeout(function () {
                window.location.href = '#projects'
            }, 1000);
            setTimeout(function () {
                sun.classList.toggle('explode')
                sun.children[0].classList.toggle('landing-noise-2');
                sun.classList.toggle('z-20');
                img.classList.toggle('hidden');
            }, 3000);
        }
    </script>
@endpush
