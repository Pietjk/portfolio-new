<section class="min-h-screen bg-gradient-to-b from-purple-600 via-orange-400 to-yellow-400" id="landing">
    <div class="container mx-auto text-white min-h-full">
        <header class="text-center p-4 relative z-10" id="landing-heading">
            <h1 class="lg:text-[9.1rem] md:text-[6rem] sm:text-[5rem] text-[3.9rem]">Piet Korfmaker</h1>
            <h2 class="md:text-5xl text-4xl overflow-visible">Front end developer</h2>
        </header>

        <div class="mx-auto p-4 md:w-[444px] w-[333px] bg-purple-600/40 backdrop-blur-md rounded-md relative z-10" id="main-text-box">
            <h3 class="text-2xl">Welkom op mijn Portfolio!</h3>
            <p>
                Ik ben een web applicatie ontwikkelaar, werkzaam bij
                <u><a href="https://postis.it">Postis IT Group</a></u>.
                Ik houd mij bezig met het maken van mooie web applicaties. Zowel Front- als Backend.
            </p>
            <p class="pt-5">
                Mijn huidige specialiteiten zijn:
                <code>php/laravel</code>,
                <code>javascript/vue</code>,
                <code>css/tailwind/bootstrap</code>.
                En ik ben altijd door aan het leren.
            </p>
            <p class="pt-5">
                Wil je meer weten? Klik dan op de zon. Of kijk op mijn
                <u><a href="https://github.com/Pietjk">Github</a></u>
                of mijn
                <u><a href="https://www.linkedin.com/in/piet-korfmaker-404936232/">Linkedin</a></u>.
            </p>
        </div>
    </div>

    <a href="#" class="sun" id="sun"></a>
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
