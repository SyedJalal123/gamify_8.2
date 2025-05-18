@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/catalog.css')}}">
    <style>
        @media (max-width: 768px) { 
            .section--first {
                padding-top: 162px !important;
            } 
        }
    </style>
@endsection

@section('content')
<section class="section section--bg section--first" style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
    <!-- MOBILE FILTER DRAWER -->
    <div id="filterDrawer" class="filter-drawer d-md-none">
        <div class="d-flex justify-content-between mx-3 mb-3 align-items-center">
            <p>Filters</p>
            <button type="button" class="btn btn-danger btn-sm" onclick="toggleFilters()">X</button>
        </div>
        <form method="GET" id="mobileFilterForm" class="mb-4 px-3">
            <input type="text" name="search" class="form-control mb-3 dark" placeholder="Search..." value="{{ request('search') }}">
            <select name="sort" class="form-control mb-3 dark">
                <option value="">Recommended</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
            </select>
            @foreach ($attributes as $attribute)
                <div class="mb-3 select-2-dark">
                    <select class="form-control filter-select select2" name="attr_{{ $attribute->id }}">
                        <option value="">{{ $attribute->name }}</option>
                        @foreach ($attribute->options as $option)
                            <option value="{{ $option }}" {{ request("attr_{$attribute->id}") == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <a href="{{ route('catalog.index', [$categoryGame->id]) }}" class="btn btn-theme btn-theme-default w-100">Clear Filters</a>
        </form>
    </div>
    <!-- END MOBILE FILTER DRAWER -->
    <div class="container mb-5" style="max-width: 1118px;">
        <div class="row">
            <div class="col-12">
                <div class="row col-12">
                    <img src="{{asset($categoryGame->game->image)}}" style="width: 23px;height: max-content;">
                    <h5 class="mb-4 ml-2 text-white">{{$categoryGame->game->name}} {{ $categoryGame->title }}</h5>
                </div>
                <!-- PC FILTER DRAWER -->
                <div class="d-block d-md-none mb-3">
                    <button type="button" class="btn btn-theme btn-theme-default w-100" onclick="toggleFilters()">Filters</button>
                </div>
                <div class="d-none d-md-block mb-4 fade-in-delay-small">
                    <form method="GET" id="desktopFilterForm">
                        <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                            @foreach ($attributes as $attribute)
                                <div class="mr-3 select-2-dark" style="min-width: 200px;">
                                    <select class="form-control filter-select select2" name="attr_{{ $attribute->id }}">
                                        <option value="">{{ $attribute->name }}</option>
                                        @foreach ($attribute->options as $option)
                                            <option value="{{ $option }}" {{ request("attr_{$attribute->id}") == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                            <a href="{{ route('catalog.index', [$categoryGame->id]) }}" class="btn btn-theme btn-theme-default btn-sm">
                                Clear Filters
                            </a>
                        </div>
                        @if($categoryGame->category->id !== 1)
                        <div class="search-sort-wrapper">
                            <div class="search-input-wrapper">
                                <input type="text" name="search" class="dark" placeholder="Search" value="{{ request('search') }}" />
                                <i class="ml-2 fas fa-search"></i>
                            </div>

                            <div class="sort-dropdown">
                                <select name="sort" class="form-control fs-14 dark">
                                    <option value="">Recommended</option>
                                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                                </select>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
                <!-- END PC FILTER DRAWER -->
                <div id="itemsContainerWrapper" class="br-9 position-realative fade-in-delay">
                    <div id="itemsOverlay">
                        <div class="spinner-border text-light" role="status"></div>
                    </div>
                    @include('frontend.catalog._items', ['items' => $items])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

<script>


    $(document).ready(function() {
        // Apply Select2 to all select elements
        $('.select2').select2({
            dropdownPosition: 'below',
        });
    });

    function toggleFilters() {
        document.getElementById('filterDrawer').classList.toggle('show');
    }

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            applyAjaxFilters('desktopFilterForm'); // or 'phoneFilterForm' if you're on mobile
        }, 0.01); // 500ms delay, adjust as needed
    });

    // AJAX filter function
    function applyAjaxFilters(id) {
        const f = document.getElementById(id);
        const url = f.action || location.href;
        const params = new URLSearchParams(new FormData(f)).toString();
        const overlay = document.getElementById('itemsOverlay');
        // overlay.style.display = 'flex';

        [...document.querySelectorAll('.animate-class')]
        .slice(0, 24)
        .forEach(el => animateDetachedOverlay(el));

        fetch(`${url}?${params}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                ['itemsContainer', 'itemCount'].forEach(id =>
                    document.getElementById(id).innerHTML = doc.getElementById(id).innerHTML
                );
            })
            .finally(() => overlay.style.display = 'none');
    }

    // Apply to both desktop and phone filters
    ['desktopFilterForm', 'mobileFilterForm'].forEach(id => {
        // Search input
        document.querySelector(`#${id} input[name="search"]`)?.addEventListener('keyup', () => applyAjaxFilters(id));
        // Select2-compatible select change
        $(`#${id} select`).on('change select2:select select2:unselect', () => applyAjaxFilters(id));
    });
</script>

<script>
    // Handle pagination link click
    document.addEventListener('click', function (e) {
        const link = e.target.closest('.pagination a');
        if (link) {
            e.preventDefault();
            const url = link.getAttribute('href');
            const overlay = document.getElementById('itemsOverlay');
            overlay.style.display = 'flex';

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                document.getElementById('itemsContainer').innerHTML = doc.getElementById('itemsContainer').innerHTML;
                document.getElementById('itemCount').innerHTML = doc.getElementById('itemCount').innerHTML;
                window.scrollTo({ top: document.getElementById('itemsContainer').offsetTop - 100, behavior: 'smooth' });
            })
            .finally(() => {
                overlay.style.display = 'none';
            });
        }
    });
</script>

@endsection
