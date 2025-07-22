@extends('frontend.app')

@section('css')
    
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container d-flex flex-column px-3" style="max-width: 1000px;"> 
            <div class="d-flex fs-13 mb-5">
                <a href="{{ url('article-collections') }}" class="text-theme-primary">All Collections</a>
                <span class="mx-2"><i class="bi bi-caret-right-fill text-theme-primary"></i></span>
                <span class="text-black-40">{{ $collection->name }}</span>
            </div>

            <h3 class="fw-bold text-theme-primary mb-3">Welcome to Gamify Help Center!</h3>
            @include('frontend.includes.article_search')


            <div class="d-flex w-100">
                <div class="row-2-1 gap-2 w-100">
                    @foreach ($collection->articles as $article)
                        <a href="{{ url('articles/'. $article->slug) }}" class="px-4 py-3 default-box d-flex flex-row justify-content-between br-7">
                            <div class="d-flex flex-column">
                                <h5 class="m-0 fs-16  fw-bold">{{ $article->title }}</h5>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-caret-right-fill"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection