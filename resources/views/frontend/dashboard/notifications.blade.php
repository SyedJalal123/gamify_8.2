@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/seller-dashboard.css')}}">
    <style>

        /* .d-none {
            display: none !important;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }

            .d-md-block {
                display: block !important;
            }
        }a
         */
    </style>
    <link rel="stylesheet" href="{{asset('css/live-chat.css')}}">
@endsection

@section('content')
    <section class="section section--bg section--first">
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>

            <div class="col-md-12 col-lg-10 pt-lg-5 mt-lg-5 pm-1200-0">
                <div class="row">
                    <div class="col-12 mb-5" style="max-width: 1048px;">
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="bi bi-bell fs-20 fw-bold text-default"></i>
                            <h3 class="ml-2 mb-0 fw-bold text-theme-primary first-letter-cap">Notifications</h3>
                        </div>
                        
                        @livewire('NotificationComponent', ['type' => 'page'])

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            if(!$('.select2').hasClass('select2-container--default')){
                initPage();
            }
        });

        function initPage() {
            // Apply Select2 to all select elements
            $('.select2').select2({
                dropdownPosition: 'below',
            });

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);
        }
    </script>
@endsection