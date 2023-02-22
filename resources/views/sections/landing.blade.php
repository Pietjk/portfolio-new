<section class="min-h-screen bg-gradient-to-b from-slate-900 via-violet-900 to-indigo-600 w-full overflow-hidden" id="landing">
    <a href="#" class="sun overflow-visible" id="sun">
        <img class="z-10 absolute -bottom-5" src="{{ asset('/images/piet_logo_grain.png') }}" alt="">
    </a>

    <div class="grid-container grid grid-cols-12">
        @for ($i = 0; $i < 116; $i++)
            <div class="grid-line"></div>
        @endfor
    </div>
</section>
@push('scripts')
    <script>
        document.getElementById('sun').addEventListener('click', sunExplodes);

        function sunExplodes() {
            let sun = document.getElementById('sun')
            sun.classList.toggle('explode');
            sun.classList.toggle('z-20');

            setTimeout(function () {
                window.location.href = '#projects'
            }, 1000);
            setTimeout(function () {
                sun.classList.toggle('explode')
                sun.classList.toggle('z-20');
            }, 3000);
        }
    </script>
@endpush
