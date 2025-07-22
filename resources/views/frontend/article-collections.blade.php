@extends('frontend.app')

@section('css')

@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container d-flex flex-column px-3" style="max-width: 1000px;"> 
            <h3 class="fw-bold text-theme-primary mb-3">Welcome to Gamify Help Center!</h3>
            @include('frontend.includes.article_search')

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
        
    </script>
@endsection