<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-[#E00496] px-3 py-1 rounded-md hover:bg-[#ff00aa] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
