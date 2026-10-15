<section id="about">
    @include('components._header', [$text = 'Wie is Piet?'])
    <div class="container mx-auto text-white max-w-[1024px] px-10">
        @if (isset($aboutHeader))
            <div class="grid md:grid-cols-3 gap-x-5 items-center mb-5">
                <div class="md:col-span-2 md:order-1 order-2">
                    <h2 class="text-primary text-shadow-blue text-2xl">{{ $aboutHeader->title }}</h2>
                    <h3 class="text-secondary text-shadow-pink text-xl">{{ $aboutHeader->subtitle }}</h3>
                    <p>{!! $aboutHeader->text !!}</p>
                </div>
                <div class="px-3 pb-5 md:p-5 md:order-2 order-1">
                    <img class="image border-4 rounded-xl border-primary box-shadow-blue" src="{{ asset($aboutHeader->image_path) }}" alt="{{ $aboutHeader->title }}">
                </div>
            </div>
        @endif
        @each('components._about_paragraph', $aboutParagraphs, 'about')
        <a href="{{ asset('Downloads/CV-Piet-Korfmaker.pdf') }}" download="CV-Piet-Korfmaker.pdf" class="inline-block bg-secondary px-4 py-2 rounded-full hover:bg-[#ff00aa] hover:shadow-[0_0_50px_5px_#e00496] transition ease-in-out duration-150">
            <i class="fa-solid fa-download pe-2"></i>Download mijn CV
        </a>
    </div>
</section>
