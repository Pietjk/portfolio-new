<section class="min-h-screen w-full overflow-hidden landing" id="landing">
    <div class="absolute z-10  hidden trail-shadow" id="trail"></div>

    <div id="nav-mesh" class="w-full h-[380px] absolute bottom-0 right-0 z-[11]"></div>
    <a href="#" class="logo" id="sun-img">
        <img class="z-20 absolute -bottom-5" src="{{ asset('/images/piet_logo_grain.png') }}" alt="Piet jouke Korfmaker">
    </a>
    <a href="#" class="sun overflow-visible" id="sun" aria-label="scroll down"><div class="h-full w-full rounded-full"></div></a>

    <div class="grid-container grid grid-cols-12" id="grid-container">
        @for ($i = 0; $i < 117; $i++)
            <div class="grid-line tile-animation ease-in duration-300"></div>
        @endfor
    </div>
</section>
@push('scripts')
    <script>
        for (let i = 1; i < 7; i++) {
            setTimeout(function () {
                tileAnimate();
            }, i*500);
        }

        function tileAnimate () {
            let tiles = document.getElementsByClassName('tile-animation')
            let len = tiles.length;
            let tile = tiles[Math.floor(Math.random() * len)]

            tile.classList.add('bg-secondary');
            setTimeout(function () {
                tile.classList.remove('bg-secondary');
                tileAnimate();
            }, 3000);
        }

        document.getElementById('sun-img').addEventListener('click', sunExplodes);
        document.getElementById('sun').addEventListener('click', sunExplodes);

        function sunExplodes() {
            let sun = document.getElementById('sun')
            let img = document.getElementById('sun-img')

            sun.classList.toggle('explode');
            sun.classList.toggle('z-20');
            img.classList.toggle('hidden');

            setTimeout(function () {
                window.location.href = '#projects'
            }, 1000);
            setTimeout(function () {
                sun.classList.toggle('explode')
                sun.classList.toggle('z-20');
                img.classList.toggle('hidden');
            }, 3000);
        }
    </script>
@endpush
