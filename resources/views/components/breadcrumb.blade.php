@props(['items' => []])

@if (count($items) > 0)
    <div class="w-full border-b border-gray-300 bg-[#f7f4ee] px-6 py-4 md:px-10">
        <div class="flex flex-wrap items-center gap-2 text-[14px] text-[#6b7280]">
            @foreach ($items as $index => $item)
                @if ($index === count($items) - 1)
                    <!-- Last item - Active/Current -->
                    <span class="font-semibold text-[#243b53]">{{ $item['label'] }}</span>
                @else
                    <!-- Navigation items -->
                    <a href="{{ $item['route'] }}" class="text-[#7ea1ba] hover:text-[#243b53] transition">
                        {{ $item['label'] }}
                    </a>
                    <span class="text-gray-400">/</span>
                @endif
            @endforeach
        </div>
    </div>
@endif
