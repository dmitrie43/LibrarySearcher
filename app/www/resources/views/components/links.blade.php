<ul class="slick-dots-custom" style="display: block;" role="tablist">
    @if ($paginator->onFirstPage())
        <li role="presentation">
            <button class="slick-prev slick-arrow" aria-label="Next" type="button"
                    style="display: block;" aria-disabled="false"
                    onclick="">Prev</button>
        </li>
    @else
        <li role="presentation">
            <button class="slick-prev slick-arrow" aria-label="Next" type="button"
                    style="display: block;" aria-disabled="false"
                    onclick="window.location.href='{{ $paginator->previousPageUrl() }}'">Prev</button>
        </li>
    @endif
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="slick-active" role="presentation">
                        <button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00"
                                onclick="" aria-label="1 of 5"
                                tabindex="-1">{{ $page }}
                        </button>
                    </li>
                @else
                    <li class="" role="presentation">
                        <button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00"
                                onclick="window.location.href='{{ $url }}'" aria-label="1 of 5"
                                tabindex="-1">{{ $page }}
                        </button>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <li role="presentation">
            <button class="slick-next slick-arrow" aria-label="Next" type="button"
                    onclick="window.location.href='{{ $paginator->nextPageUrl() }}'"
                    style="display: block;" aria-disabled="false">Next</button>
        </li>
    @else
        <li role="presentation">
            <button class="slick-next slick-arrow" aria-label="Next" type="button"
                    style="display: block;" aria-disabled="false">Next</button>
        </li>
    @endif
</ul>
