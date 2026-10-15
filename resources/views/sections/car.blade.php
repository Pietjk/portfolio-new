<div class="py-32 overflow-x-hidden">
    <img class="pt-10 car max-w-200" src="{{asset('images/car.png')}}" alt="" id="car">
    <div class="w-full h-5 bg-secondary box-shadow-intense-pink" id="road"></div>
</div>
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
