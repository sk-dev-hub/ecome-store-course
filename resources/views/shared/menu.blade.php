<nav class="hidden xl:flex gap-8">
    
    @foreach ($menu->all() as $item)
        <a 
            href="{{ $item->link() }}" 
            class="
                text-white hover:text-pink
                @if($item->isActive())
                    font-bold
                @endif
                "
        >
            {{ $item->lable() }}
        </a>
    @endforeach
    
    {{-- <a href="{{ route('home') }}" class="text-white hover:text-pink font-bold">Главная</a>
    <a href="{{ route('catalog') }}" class="text-white hover:text-pink font-bold">Каталог</a>
    <a href="#" class="text-white hover:text-pink font-bold">Корзина</a> --}}
</nav>