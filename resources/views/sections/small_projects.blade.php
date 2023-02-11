<section id="projects-sm">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Kleine Projecten'])
        <div class="grid grid-cols-2 gap-x-5 px-10">
            <div class="p-3">
                <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue md:order-2 order-1" src="{{asset('images/landings/randomfilename.png')}}" alt="De Ruben Korfmaker landing pagina">
                <h2 class="text-xl text-[#E00496] text-shadow-pink pt-3">Bestand hernoemer</h2>
                <p>Met dit programma kan de gebruiker alle bestanden in een gegeven map veranderen naar een random gegenereerde naam.</p>
            </div>
            <div class="p-3">
                <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue md:order-2 order-1" src="{{asset('images/landings/imageresizer.png')}}" alt="De Ruben Korfmaker landing pagina">
                <h2 class="text-xl text-[#E00496] text-shadow-pink pt-3">Foto verkleiner</h2>
                <p>Met dit programma kan de gebruiker alle afbeeldingen in een gegeven map verkleinen.</p>
            </div>
        </div>
    </div>
    <img class="pt-5 car" src="{{asset('images/car.png')}}" alt="" id="car">
    <div class="w-100 h-5 bg-[#E00496] box-shadow-intense-pink"></div>
</section>

<script>
    window.addEventListener("scroll", isHidden);
function moveCar() {
    const position = document.getElementById('car').getBoundingClientRect();

    if(position.top >= 0 && position.bottom <= window.innerHeight) {
        console.log('car!');
    }
}
</script>
