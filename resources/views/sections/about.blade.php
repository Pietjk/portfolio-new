<section id="about">
    @include('components._header', [$text = 'Over Mij'])
    <div class="container mx-auto text-white max-w-[1024px] px-10">
        <div class="grid md:grid-cols-3 gap-x-5 items-center">
            <div class="col-span-2 md:order-1 order-2">
                <h2 class="text-[#09aac0] text-shadow-blue text-2xl">Piet Korfmaker</h2>
                <p>Hallo, ik ben Piet Korfmaker. Een web developer bij Posis IT Group. Ik houd mij bezig met het schrijven code die zowel in de back- als de frontend draait.</p>
                <p>De talen en frameworks waar ik het meeste mee doe zijn:</p>
                <ul class="list-disc">
                    <li><code>php/laravel</code></li>
                    <li><code>javascript/vue</code></li>
                    <li><code>css/tailwind/bootstrap</code></li>
                </ul>
                <p>Naast deze talen ben ik ook geïnteresseerd in <code>python</code> en <code>C#</code>. Met de Python heb ik al een aantal keine apps gemaakt. Met C# heb ik wat gamedevelopment geprobeerd.</p>
            </div>
            <div class="px-3 pb-5 mb:p-5 md:order-2 order-1">
                <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue" src="{{ asset('images/piet.jpg') }}" alt="Piet Korfmaker">
            </div>
        </div>
        <h2 class="text-[#09aac0] text-shadow-blue text-2xl">ROC de Friese Poort</h2>
        <h3 class="text-[#E00496] text-shadow-pink text-xl">MBO Applicatie- en Media Ontwikkeling</h3>
        <p>Ik heb deze opleiding in iets meer dan 3 jaar afgerond met <code>9</code> als eindcijfer. Op deze opleiding hebben we vooral les gehad in <code>php</code>. Maar ik kreeg <i>de Klik</i> pas toen ik in het laatste jaar als mijn project een game ging ontwikkelen in <code>C#</code>.</p>
        <h2 class="text-[#09aac0] text-shadow-blue text-2xl">b&t onderwijs</h2>
        <h3 class="text-[#E00496] text-shadow-pink text-xl">Stagiair</h3>
        <p>Na 3 jaar studie was ik eindelijk klaar voor mijn eindstage die ik bij b&t onderwijs heb mogen doen. In eerste instantie was ik een beetje bang om een stage te doen met php. Maar nadat ik geïntroduceerd werd aan laravel is het allemaal helemaal goed gekomen. Zeker ook dankzij de fantastische begeleiding van mijn stage begeleider.</p>
        <h2 class="text-[#09aac0] text-shadow-blue text-2xl">Postis IT Group</h2>
        <h3 class="text-[#E00496] text-shadow-pink text-xl">Junior Developer</h3>
        <p>Na mijn stage is de development tak van b&t onderwijs afgesplitst en een zutser bedrijf geworden van b&t onderwijs. Dat is Postis It Group. Daar werk ik nu al bijna 3 jaar aan web apps.</p>
    </div>
</section>
