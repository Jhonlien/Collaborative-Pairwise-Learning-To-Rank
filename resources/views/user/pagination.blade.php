@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true"><i class="material-icons">chevron_left</i></span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
@else
            <li class="waves-effect"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev"><i class="material-icons">chevron_left</i></a></li>
@endif

{{-- Pagination Elements --}}
@foreach ($elements as $element)
{{-- "Three Dots" Separator --}}
    @if (is_string($element))
            <li class="disabled">{{ $element }}</li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
        @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                        <li class="active teal">
                            <a href="#" class="page-link">{{ $page }}<span class="sr-only">(current)</span></a>
                        </li>
                @else
                        <li class="waves-effect">
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
                <li class="waves-effect"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next"><i class="material-icons">chevron_right</i></a></li>
        @else
                <li class="waves-effect disabled">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
        @endif
    </ul>
    @endif