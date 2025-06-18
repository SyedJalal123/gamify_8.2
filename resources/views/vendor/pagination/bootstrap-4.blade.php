@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a @if(request()->segments()[0] !== 'catalog') wire:navigate @endif class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a @if(request()->segments()[0] !== 'catalog') wire:navigate @endif class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a @if(request()->segments()[0] !== 'catalog') wire:navigate @endif class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif


{{-- @if ($paginator->hasPages())
    <nav>
        <ul class="pagination">

            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a @if(request()->segments()[0] !== 'catalog') wire:navigate @endif class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $max = 4;

                $start = max(2, $current - 1);
                $end = min($last - 1, $current + 1);

                if ($current == 1) $end = min($last - 1, $current + 2);
                if ($current == $last) $start = max(2, $current - 2);

                if ($end - $start < $max - 2) {
                    $start = max(2, $end - ($max - 2));
                    $end = min($last - 1, $start + ($max - 2));
                }
            @endphp

            <!-- First page -->
            <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            </li>

            <!-- Dots before window -->
            @if ($start > 2)
                <li class="page-item disabled"><span class="page-link">…</span></li>
            @endif

            <!-- Page range -->
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $current == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            <!-- Dots after window -->
            @if ($end < $last - 1)
                <li class="page-item disabled"><span class="page-link">…</span></li>
            @endif

            <!-- Last page -->
            @if ($last > 1)
                <li class="page-item {{ $current == $last ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a>
                </li>
            @endif

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a @if(request()->segments()[0] !== 'catalog') wire:navigate @endif class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif

        </ul>
    </nav>
@endif --}}

