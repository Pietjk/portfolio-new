<section class="min-h-screen bg-gradient-to-b from-slate-900 via-violet-900 to-indigo-600" id="landing">
    <a href="#" class="sun" id="sun"></a>
    <div class="grid-container grid grid-cols-12">
        @for ($i = 0; $i < 116; $i++)
            <div class="grid-line"></div>
        @endfor
    </div>
</section>
<script>
     document.getElementById('sun').addEventListener('click', sunExplodes);

    function sunExplodes() {
        let sun = document.getElementById('sun')
        sun.classList.toggle('explode');
        sun.classList.toggle('z-20');

        setTimeout(function () {
            window.location.href = '#experiences'
        }, 1000);
        setTimeout(function () {
            sun.classList.toggle('explode')
            sun.classList.toggle('z-20');
        }, 3000);
    }
</script>
