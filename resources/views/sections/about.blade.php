<section id="about">
    @include('components._header', [$text = 'Over Mij'])
    <div class="container mx-auto text-white max-w-[1024px] px-10">
        @if (isset($aboutHeader))
            <div class="grid md:grid-cols-3 gap-x-5 items-center mb-5">
                <div class="col-span-2 md:order-1 order-2">
                    <h2 class="text-[#09aac0] text-shadow-blue text-2xl">{{ $aboutHeader->title }}</h2>
                    <p>{!! $aboutHeader->text !!}</p>
                </div>
                <div class="px-3 pb-5 mb:p-5 md:order-2 order-1">
                    <img class="image border-4 rounded-xl border-[#09aac0] box-shadow-blue" src="{{ asset($aboutHeader->image_path) }}" alt="{{ $aboutHeader->title }}">
                </div>
            </div>
        @endif
        @each('components._about_paragraph', $aboutParagraphs, 'about')
    </div>
</section>
