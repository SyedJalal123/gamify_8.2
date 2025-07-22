@extends('frontend.app')

@section('css')
    <style>
        /* .description-text p, .description-text li {
            color: #e6e6e6 !important;
        }
        strong {
            color: var(--text-primary) !important;
        } */
        
        .header {
            padding-bottom: 57px !important;
        }
        @media (min-width: 768px) {
            .header {
                padding-bottom: 80px !important;
            }
        }

        .footer {
            background: var(--background-body-1) !important;
        }

        body {
            background-color: white !important;
        }

        section {
            background-color: white !important;
            color: #000 !important;
        }

        a {
            color: #000;
        }

        dl, ol, ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        ul {
            display: block;
            list-style-type: disc;
            margin-block-start: 1em;
            margin-block-end: 1em;
            padding-inline-start: 40px;
            unicode-bidi: isolate;
        }

        .section--bg::before {
            background: linear-gradient(to bottom, rgb(73 90 124 / 84%) 0%, #ffffff 100%);
            top: 0 !important;
        }
        
        .section .header__form {
            border: 1px solid rgb(237 237 237 / 38%);
        }

        .description-text img {
            cursor: pointer;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="container d-flex flex-column px-3" style="max-width: 1000px;"> 
            <div class="d-flex fs-13 mb-3 pt-4">
                <a href="{{ url('article-collections') }}">All Collections</a>
                <span class="mx-2"><i class="bi bi-caret-right-fill"></i></span>
                <a href="{{ url('article-collections/'. $article->collection->slug) }}">{{ $article->collection->name }}</a>
                <span class="mx-2"><i class="bi bi-caret-right-fill"></i></span>
                <span class="text-black-40">{{ $article->title }}</span>
            </div>
            {{-- <h3 class="fw-bold text-theme-primary mb-3">Welcome to Gamify Help Center!</h3> --}}
            @include('frontend.includes.article_search')


            <div class="d-flex w-100 mt-3">
                <div class="w-100">
                    <h2 class=" fw-bold mb-5">{{ $article->title }}</h2>
                    <div class="description-text pb-5">
                        {!! $article->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.description-text img').forEach(img => {
            img.addEventListener('click', function () {
                window.open(this.src, '_blank');
            });
        });
    </script>
@endsection