@extends('frontend.app')

@section('css')

@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container d-flex flex-column p-0" style="max-width: 1000px;"> 
            <h3 class="fw-bold text-theme-primary mb-3">Welcome to Gamify Help Center!</h3>
            <!-- Input + Dropdown -->
            <div class="custom-search-container mb-3">
                <div class="header__form w-100">
                    <input type="text" id="customArticleSearchInput" onkeyup="get_articles()" class="header__input w-100" autocomplete="off" placeholder="Search for articles...">
                    <button class="header__btn" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 512 512">
                            <path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z"
                                    style="fill:none;stroke:white;stroke-width:32px"/>
                            <line x1="338.29" y1="338.29" x2="448" y2="448"
                                    style="fill:none;stroke:white;stroke-linecap:round;stroke-width:32px"/>
                        </svg>
                    </button>
                </div>
        
                <!-- Results Dropdown -->
                <div id="customArticleSearchDropdown" class="custom-search-dropdown max-w-100">
                    <!-- -->
                </div>
            </div>

            <div class="d-flex w-100">
                <div class="row-2-1 gap-2 w-100">
                    @foreach ($collections as $collection)
                        <a href="{{ url('article-collections/'. $collection->slug) }}" class="p-4 default-box br-7">
                            <div class="d-flex flex-column">
                                <h5 class="mb-2 fs-16  fw-bold">{{ $collection->name }}</h5>
                                <div class="d-flex flex-row fs-14 text-theme-secondary">
                                    <span>By Gamify</span>
                                    <span class="mx-2">-</span>
                                    <span>{{ count($collection->articles) }} articles</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function get_articles() {
            var search = $('#customArticleSearchInput').val();

            $('#customArticleSearchDropdown').empty();

            if(search == '' || search == null) {
                $('#customArticleSearchDropdown').css('visibility','hidden').css('opacity',0);
            } else {
                $('#customArticleSearchDropdown').css('visibility','visible').css('opacity',1);

                html = `<span class="p-3 text-theme-primary">Searching</span>`;
                $('#customArticleSearchDropdown').append(html);
            }

            $.ajax({
                url: '/get-articles-search',
                method: 'GET',
                data: { 
                    search: search, 
                },
                success: function (response) {
                    var html = '';
                    for(var i = 0; i < response.length; i++) {
                        html += 
                        // set the style of frontend and remove all the errors
                        `<a href="${homePath}articles/${response[i].slug}" class="p-3 default-border-box br-7">
                            <div class="d-flex flex-column">
                                <h5 class="mb-2 fs-16  fw-bold">${response[i].title}</h5>
                                <div class="d-flex flex-column fs-14 text-theme-secondary">${response[i].short_description}</div>
                            </div>
                        </a>`;
                    }
                    
                    $('#customArticleSearchDropdown').empty();

                    if(html == '' || html == null) {
                        html = `<span class="p-3 text-theme-primary">No results found</span>`;
                        $('#customArticleSearchDropdown').append(html);
                    }else {
                        $('#customArticleSearchDropdown').append(html);
                    }
                }
            });
        }
    </script>
@endsection