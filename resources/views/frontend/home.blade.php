@extends('frontend.app')

@section('css')
    <style>
        @media (min-width: 1200px) {
            .section--first {
                padding-top: 210px;
            }
        }

        .section--first {
            background: url('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bgg.jpg') center top 140px / auto 500px no-repeat;
        }

        .info-details-box {
            height: 154px;
            width: 125px;
        }

        @media (max-width:768px) {
            .home-items-row {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                overflow: scroll;
            }

            .section--first {
                background: url('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg-2-sm.jpg') center top 140px / auto 500px no-repeat;
            }

            .info-details-box {
                height: 154px;
                width: 125px;
            }
        }

        .home-item-name {
            color: var(--text-primary);
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            margin: 11px 0px;
            font-family: 'Montserrat', sans-serif;
        }

        .home-item-box-1 {
            box-shadow: 0 0 20px 4px rgb(0 0 0 / 34%) !important;
        }

        .home-item-box {
            width: 150px;height: 120px;
            box-shadow: 0 0 20px 4px rgb(0 0 0 / 10%);
        }
        
    </style>
@endsection

@section('content')
    <!-- home -->
    <section class="section section--bg section--first">
        {{-- <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="mb-3">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="section__title-wrap">
                        <h2 class="section__title section__title--title"><b>Best games</b> of this month</h2>

                        <div class="section__nav-wrap">
                            <button class="section__nav section__nav--bg section__nav--prev" type="button" data-nav="#carousel0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                    <polyline points="328 112 184 256 328 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"></polyline>
                                </svg>
                            </button>

                            <button class="section__nav section__nav--bg section__nav--next" type="button" data-nav="#carousel0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                    <polyline points="184 112 328 256 184 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end title -->
            </div>
        </div>

        <!-- carousel -->
        <div class="owl-carousel section__carousel section__carousel--big owl-loaded" id="carousel0">
            <!-- big card -->

            <!-- end big card -->

            <!-- big card -->

            <!-- end big card -->

            <!-- big card -->

            <!-- end big card -->

            <!-- big card -->

            <!-- end big card -->
            <div class="owl-stage-outer owl-height" style="height: 412px;">
                <div class="owl-stage" style="transform: translate3d(-1310px, 0px, 0px); transition: all; width: 5240px;">
                    <div class="owl-item cloned" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/9.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">The Legend of Heroes: Trails in the Sky SC</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 07.12.2015</li>
                                    <li><span>Genres:</span> Role-playing, Turn-based, Fantasy</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path>
                                            <path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path>
                                            <path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path>
                                        </svg></li>
                                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path>
                                            <path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path>
                                            <path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path>
                                            <path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path>
                                        </svg></li>
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$14.99</span><s>$29.99</s><b>50% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">Pillars of Eternity: Hero Edition</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 18.09.2019</li>
                                    <li><span>Genres:</span> Role-playing, Adventure, Fantasy</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path>
                                            <path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$17.99</span><s>$29.99</s><b>40% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">X4: Foundations Collector's Edition</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 30.11.2018</li>
                                    <li><span>Genres:</span> Simulation, Action, Sci-fi</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path>
                                            <path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path>
                                            <path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path>
                                        </svg></li>
                                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path>
                                            <path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path>
                                            <path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path>
                                            <path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path>
                                        </svg></li>
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$59.99</span><s>$79.99</s><b>30% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">The Witcher 3: Wild Hunt</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 24.03.2016</li>
                                    <li><span>Genres:</span> Action, Role Playing, Open World</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path>
                                            <path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path>
                                            <path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path>
                                        </svg></li>
                                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path>
                                            <path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path>
                                            <path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path>
                                            <path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path>
                                        </svg></li>
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path>
                                            <path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$15.36</span><s>$38.80</s><b>60% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/9.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">The Legend of Heroes: Trails in the Sky SC</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 07.12.2015</li>
                                    <li><span>Genres:</span> Role-playing, Turn-based, Fantasy</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path>
                                            <path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path>
                                            <path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path>
                                        </svg></li>
                                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path>
                                            <path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path>
                                            <path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path>
                                            <path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path>
                                        </svg></li>
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$14.99</span><s>$29.99</s><b>50% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">Pillars of Eternity: Hero Edition</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 18.09.2019</li>
                                    <li><span>Genres:</span> Role-playing, Adventure, Fantasy</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path>
                                            <path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$17.99</span><s>$29.99</s><b>40% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">X4: Foundations Collector's Edition</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 30.11.2018</li>
                                    <li><span>Genres:</span> Simulation, Action, Sci-fi</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path>
                                            <path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path>
                                            <path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path>
                                        </svg></li>
                                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path>
                                            <path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path>
                                            <path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path>
                                            <path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path>
                                        </svg></li>
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$59.99</span><s>$79.99</s><b>30% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 625px; margin-right: 30px;">
                        <div class="card card--big">
                            <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                                <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2.jpg')}}" alt="">
                            </a>

                            <div class="card__wrap">
                                <div class="card__title">
                                    <h3><a href="https://gogame.volkovdesign.com/details.html">The Witcher 3: Wild Hunt</a></h3>
                                </div>

                                <ul class="card__list">
                                    <li><span>Release date:</span> 24.03.2016</li>
                                    <li><span>Genres:</span> Action, Role Playing, Open World</li>
                                </ul>

                                <ul class="card__platforms">
                                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path>
                                            <path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path>
                                            <path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path>
                                        </svg></li>
                                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path>
                                            <path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path>
                                            <path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path>
                                            <path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path>
                                        </svg></li>
                                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,265H232V444l248,36V265Z"></path>
                                            <path d="M216,265H32V415l184,26.7V265Z"></path>
                                            <path d="M480,32,232,67.4V249H480V32Z"></path>
                                            <path d="M216,69.7,32,96V249H216V69.7Z"></path>
                                        </svg></li>
                                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path>
                                            <path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path>
                                        </svg></li>
                                </ul>

                                <div class="card__price">
                                    <span>$15.36</span><s>$38.80</s><b>60% OFF</b>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy" type="button">Buy now</button>

                                    <button class="card__favorite" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
            <div class="owl-dots disabled"></div>
        </div>
        <!-- end carousel --> --}}

        <div class="container dividor-border-theme-bottom">
            <div class="section__title-wrap mb-0 pb-1">
                <h2 class="section__title fs-24 text-shadow-5">Trending Game <strong>Accounts</strong></h2>

                <div class="section__nav-wrap">
                    <a href="catalog.html" class="section__view">View All</a>
                </div>
            </div>
            <div class="home-items-row row pt-5">
                @foreach ($accounts as $account)
                <a wire:navigate class="col-md-3 px-0 col-lg-2 mb-5" href="{{ url('catalog/'.$account->id) }}">
                    <div class="d-flex flex-column justify-content-end align-items-center mx-3 border-theme-1 background-theme-body-1 border-theme-1-hover br-5 home-item-box"
                        style="
                        /* background: {{$account->game->background}} !important; */
                        /* background: #1f37a014; */
                        /* box-shadow: {{$account->game->glow}}; */
                        ">

                        <img src="{{ asset('uploads/games/show/'.$account->game->show_image) }}" class="br-5" 
                        style="width: 100px; height: fit-content;
                        filter: drop-shadow(0 0 6px {{$account->game->glow_2}}
                        " >

                        <span class="home-item-name">{{ $account->game->name }}</span>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="container dividor-border-theme-bottom">
            <div class="section__title-wrap mb-0 pt-5 pb-1">
                <h2 class="section__title fs-24">Trending Game <strong>Currencies</strong></h2>

                <div class="section__nav-wrap">
                    <a href="catalog.html" class="section__view">View All</a>
                </div>
            </div>
            <div class="home-items-row row pt-5">
                @foreach ($currencies as $account)
                <a wire:navigate class="col-md-3 px-0 col-lg-2 mb-5" href="{{ url('catalog/'.$account->id) }}">
                    <div class="d-flex flex-column justify-content-end align-items-center mx-3 border-theme-1 background-theme-body-1 border-theme-1-hover br-5 home-item-box"
                    style="
                    /* background: {{$account->game->background}} !important; */
                    /* background: #1f37a014; */
                    /* box-shadow: {{$account->game->glow}}; */
                    ">

                        <img src="{{ asset('uploads/games/show/'.$account->game->show_image) }}" class="br-5" 
                        style="width: 100px; height: fit-content;
                        filter: drop-shadow(0 0 6px {{$account->game->glow_2}}
                        " >

                        <span class="home-item-name">{{ $account->game->name }} {{ $account->title }}</span>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="container dividor-border-theme-bottom">
            <div class="section__title-wrap mb-0 pt-5 pb-1">
                <h2 class="section__title fs-24">Trending Game <strong>Top Up</strong></h2>

                <div class="section__nav-wrap">
                    <a href="catalog.html" class="section__view">View All</a>
                </div>
            </div>
            <div class="home-items-row row pt-5">
                @foreach ($topups as $account)
                <a wire:navigate class="col-md-3 px-0 col-lg-2 mb-5" href="{{ url('catalog/'.$account->id) }}">
                    <div class="d-flex flex-column justify-content-end align-items-center mx-3 border-theme-1 background-theme-body-1 border-theme-1-hover br-5 home-item-box"
                    style="
                    /* background: {{$account->game->background}} !important; */
                    /* background: #1f37a014; */
                    /* box-shadow: {{$account->game->glow}}; */
                    ">

                        <img src="{{ asset('uploads/games/show/'.$account->game->show_image) }}" class="br-5" 
                        style="width: 100px; height: fit-content;
                        filter: drop-shadow(0 0 6px {{$account->game->glow_2}}
                        " >

                        <span class="home-item-name">{{ $account->game->name }} {{ $account->title }}</span>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="section__title-wrap mb-0 pt-5 pb-1">
                <h2 class="section__title fs-24">Trending Game <strong>Items</strong></h2>

                <div class="section__nav-wrap">
                    <a href="catalog.html" class="section__view">View All</a>
                </div>
            </div>
            <div class="home-items-row row pt-5">
                @foreach ($items as $account)
                <a wire:navigate class="col-md-3 px-0 col-lg-2 mb-5" href="{{ url('catalog/'.$account->id) }}">
                    <div class="d-flex flex-column justify-content-end align-items-center mx-3 border-theme-1 background-theme-body-1 border-theme-1-hover br-5 home-item-box"
                    style="
                    /* background: {{$account->game->background}} !important; */
                    /* background: #1f37a014; */
                    /* box-shadow: {{$account->game->glow}}; */
                    ">

                        <img src="{{ asset('uploads/games/show/'.$account->game->show_image) }}" class="br-5" 
                        style="width: 100px; height: fit-content;
                        filter: drop-shadow(0 0 6px {{$account->game->glow_2}}
                        " >

                        <span class="home-item-name">{{ $account->game->name }}</span>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section d-flex justify-content-center mb-5">
        <div class="container row justify-content-center">
            <div class="col-md-6 col-12 d-flex flex-column flex-md-row px-5 py-5 mr-md-4 mb-3 br-33" style="background-color: var(--brand-yellow-4);max-width: 585px;">
                <div style="height: 154px;" class="mr-4">
                    <img class="info-details-box" loading="lazy" src="https://assetsdelivery.eldorado.gg/v7/_assets_/home-page/v1/trade-shield.svg?q=40" srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/home-page/v1/trade-shield.svg?w=125&amp;q=40 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/home-page/v1/trade-shield.svg?w=250&amp;q=40 2x">
                </div>
                <div class="">
                    <div class="text">
                        <h5 class="fw-bold">Money-Back Guarantee</h5>
                        <p class="fs-16">Receive your order or get a refund. Feel safe with full trading protection!</p>
                    </div>
                    <button class="btn form__btn py-2" type="button" aria-label="Learn more">
                        Learn more
                    </button>
                </div>
            </div>
            <div class="col-md-6 col-12 d-flex flex-column flex-md-row px-5 py-5 br-33" style="background-color: var(--brand-sulu);max-width: 585px;">
                <div style="height: 154px;" class="mr-4">
                    <img class="app-image" alt="Chat support" height="144" width="126" loading="lazy" fetchpriority="auto" ng-img="true" src="https://assetsdelivery.eldorado.gg/v7/_assets_/home-page/v1/chat-support.svg?q=40" srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/home-page/v1/chat-support.svg?w=126&amp;q=40 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/home-page/v1/chat-support.svg?w=252&amp;q=40 2x">
                </div>
                <div class="">
                    <div class="text">
                        <h5 class="fw-bold">24/7 Live Support</h5>
                        <p class="fs-16">Gamify support works around the clock. Contact us at any time!</p>
                    </div>
                    <button class="btn form__btn py-2" type="button" aria-label="Chat now">
                        Chat now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- end home -->

    {{-- <!-- section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title">Latest releases</h2>

                        <div class="section__nav-wrap">
                            <a href="https://gogame.volkovdesign.com/catalog.html" class="section__view">View All</a>

                            <button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><polyline points="328 112 184 256 328 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"></polyline></svg>
                            </button>

                            <button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><polyline points="184 112 328 256 184 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end title -->
            </div>
        </div>

        <!-- carousel -->
        <div class="owl-carousel section__carousel section__carousel--catalog owl-loaded" id="carousel1">
            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->
        <div class="owl-stage-outer owl-height" style="height: 518.656px;"><div class="owl-stage" style="transform: translate3d(-1310px, 0px, 0px); transition: all; width: 3930px;"><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Desperados III Digital Deluxe Edition</a></h3>
                    <span>$49.00</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/7.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Red Dead Redemption 2</a></h3>
                    <span>$34.99 <s>$49.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Dandara: Trials of Fear Edition</a></h3>
                    <span>$7.99 <s>$19.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/8.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Druidstone: The Secret of the Menhir Forest</a></h3>
                    <span>$12.49</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Baldur's Gate II: Enhanced Edition</a></h3>
                    <span>$19.00</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Desperados III Digital Deluxe Edition</a></h3>
                    <span>$49.00</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/7.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Red Dead Redemption 2</a></h3>
                    <span>$34.99 <s>$49.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Dandara: Trials of Fear Edition</a></h3>
                    <span>$7.99 <s>$19.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/8.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Druidstone: The Secret of the Menhir Forest</a></h3>
                    <span>$12.49</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Baldur's Gate II: Enhanced Edition</a></h3>
                    <span>$19.00</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Desperados III Digital Deluxe Edition</a></h3>
                    <span>$49.00</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/7.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Red Dead Redemption 2</a></h3>
                    <span>$34.99 <s>$49.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Dandara: Trials of Fear Edition</a></h3>
                    <span>$7.99 <s>$19.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/8.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Druidstone: The Secret of the Menhir Forest</a></h3>
                    <span>$12.49</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3.jpg')}}" alt="">
                    <span class="card__new">New</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Baldur's Gate II: Enhanced Edition</a></h3>
                    <span>$19.00</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Buy</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
        <!-- end carousel -->
    </section>
    <!-- end section -->

    <!-- section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title section__title--pre">Pre-orders</h2>

                        <div class="section__nav-wrap">
                            <a href="https://gogame.volkovdesign.com/catalog.html" class="section__view">View All</a>

                            <button class="section__nav section__nav--prev" type="button" data-nav="#carousel2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><polyline points="328 112 184 256 328 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"></polyline></svg>
                            </button>

                            <button class="section__nav section__nav--next" type="button" data-nav="#carousel2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><polyline points="184 112 328 256 184 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end title -->
            </div>
        </div>

        <!-- carousel -->
        <div class="owl-carousel section__carousel section__carousel--catalog owl-loaded" id="carousel2">
            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->

            <!-- card -->
            
            <!-- end card -->
        <div class="owl-stage-outer owl-height" style="height: 518.656px;"><div class="owl-stage" style="transform: translate3d(-1310px, 0px, 0px); transition: all; width: 3930px;"><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/6.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Baldur's Gate: Enhanced Edition</a></h3>
                    <span>$19.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Dandara: Trials of Fear Edition</a></h3>
                    <span>$7.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">SteamWorld Quest: Hand of Gilgamech</a></h3>
                    <span>$12.49</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/9.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">BioShock Infinite Complete Edition</a></h3>
                    <span>$55.99 <s>$79.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Outcast - Second Contact</a></h3>
                    <span>$34.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/6.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Baldur's Gate: Enhanced Edition</a></h3>
                    <span>$19.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Dandara: Trials of Fear Edition</a></h3>
                    <span>$7.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">SteamWorld Quest: Hand of Gilgamech</a></h3>
                    <span>$12.49</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/9.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">BioShock Infinite Complete Edition</a></h3>
                    <span>$55.99 <s>$79.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item active" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Outcast - Second Contact</a></h3>
                    <span>$34.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/6.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Baldur's Gate: Enhanced Edition</a></h3>
                    <span>$19.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Dandara: Trials of Fear Edition</a></h3>
                    <span>$7.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">SteamWorld Quest: Hand of Gilgamech</a></h3>
                    <span>$12.49</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/9.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                    <li class="ap"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"></path><path d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">BioShock Infinite Complete Edition</a></h3>
                    <span>$55.99 <s>$79.99</s></span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div><div class="owl-item cloned" style="width: 232px; margin-right: 30px;"><div class="card">
                <a href="https://gogame.volkovdesign.com/details.html" class="card__cover">
                    <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4.jpg')}}" alt="">
                    <span class="card__preorder">Pre-order</span>
                </a>

                <ul class="card__platforms">
                    <li class="ps"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M399.77,203c-.8-17.1-3.3-34.5-10.8-50.1a82.45,82.45,0,0,0-16.5-23.2,105.59,105.59,0,0,0-21.3-16.3c-17.1-10.2-37.5-17-84.4-31S192,64,192,64V422.3l79.9,25.7s.1-198.8.1-299.5v-3.8c0-9.3,7.5-16.8,16.1-16.8h.5c8.5,0,15.5,7.5,15.5,16.8V278c11,5.3,29.2,9.3,41.8,9.1a47.79,47.79,0,0,0,24-5.7,49.11,49.11,0,0,0,18.4-17.8,78.64,78.64,0,0,0,9.9-27.3C400.07,225.5,400.17,214.2,399.77,203Z"></path><path d="M86.67,357.8c27.4-9.8,89.3-29.5,89.3-29.5V281.1s-76.5,24.8-111.3,37.1c-8.6,3.1-17.3,5.9-25.7,9.5-9.8,4.1-19.4,8.7-28.1,14.8a26.29,26.29,0,0,0-9.2,10.1,17.36,17.36,0,0,0-.5,13.6c2,5.1,5.8,9.3,10.1,12.6,7.8,5.9,17.1,9.5,26.4,12.2a262.42,262.42,0,0,0,88.4,13.3c14.5-.2,36-1.9,50-4.4v-42s-11,2.5-41.3,12.5c-4.6,1.5-9.2,3.3-14,4.3a104.87,104.87,0,0,1-21.6,2.2c-6.5-.3-13.2-.7-19.3-3.1-2.2-1-4.6-2.2-5.5-4.6-.8-2,.3-4,1.7-5.4C78.87,360.9,82.87,359.3,86.67,357.8Z"></path><path d="M512,345.9c-.1-6-3.7-11.2-7.9-15-7.1-6.3-15.9-10.3-24.7-13.5-5.5-1.9-9.3-3.3-14.7-5-25.2-8.2-51.9-11.2-78.3-11.3-8,.3-23.1.5-31,1.4-21.9,2.5-67.3,15.4-67.3,15.4v48.8s67.5-21.6,96.5-31.8a94.43,94.43,0,0,1,30.3-4.6c6.5.2,13.2.7,19.4,3.1,2.2.9,4.5,2.2,5.5,4.5.9,2.6-.9,5-2.9,6.5-4.7,3.8-10.7,5.3-16.2,7.4-41,14.5-132.7,44.7-132.7,44.7v47s117.2-39.6,170.8-58.8c8.9-3.3,17.9-6.1,26.4-10.4,7.9-4,15.8-8.6,21.8-15.3A19.74,19.74,0,0,0,512,345.9Z"></path></svg></li>
                    <li class="xb"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M126.8,248.3c39.7-58.6,77.9-92.8,77.9-92.8s-42.1-48.9-92.8-67.4l-3.3-.8A224.13,224.13,0,0,0,77.2,391C77.2,386.6,77.8,320.7,126.8,248.3Z"></path><path d="M480,256A223.71,223.71,0,0,0,403.4,87.3l-3.2.9c-50.7,18.5-92.9,67.4-92.9,67.4s38.2,34.2,77.9,92.8c49,72.4,49.6,138.3,49.5,142.7A222.8,222.8,0,0,0,480,256Z"></path><path d="M201.2,80.9c29.3,13.1,54.6,34.6,54.6,34.6s25.5-21.4,54.8-34.6c36.8-16.5,64.9-11.3,72.3-9.5a224.06,224.06,0,0,0-253.8,0C136.3,69.6,164.3,64.3,201.2,80.9Z"></path><path d="M358.7,292.9C312.4,236,255.8,199,255.8,199s-56.3,37-102.7,93.9c-39.8,48.9-54.6,84.8-62.6,107.8l-1.3,4.8a224,224,0,0,0,333.6,0l-1.4-4.8C413.4,377.7,398.5,341.8,358.7,292.9Z"></path></svg></li>
                    <li class="wn"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M480,265H232V444l248,36V265Z"></path><path d="M216,265H32V415l184,26.7V265Z"></path><path d="M480,32,232,67.4V249H480V32Z"></path><path d="M216,69.7,32,96V249H216V69.7Z"></path></svg></li>
                </ul>

                <div class="card__title">
                    <h3><a href="https://gogame.volkovdesign.com/details.html">Outcast - Second Contact</a></h3>
                    <span>$34.99</span>
                </div>

                <div class="card__actions">
                    <button class="card__buy" type="button">Pre-order</button>

                    <button class="card__favorite" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path></svg>
                    </button>
                </div>
            </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
        <!-- end carousel -->
    </section>
    <!-- end section -->

    <!-- section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- title -->
                            <div class="section__title-wrap section__title-wrap--single">
                                <h2 class="section__title section__title--small">Gaming cards</h2>

                                <div class="section__nav-wrap">
                                    <a href="https://gogame.volkovdesign.com/#" class="section__view">View All</a>
                                </div>
                            </div>
                            <!-- end title -->

                            <!-- cards -->
                            <ul class="list list--mb">
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/7.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">The Evil Within: The Assignment</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$1.99</span><s>$4.99</s><b>60% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">DROD 4: Gunthro and the Epic Blunder</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$4.99</span><s>$9.99</s><b>50% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">Conquests of the Longbow: The Legend of Robin Hood</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$3.59</span><s>$5.99</s><b>40% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                            <!-- end cards -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- title -->
                            <div class="section__title-wrap section__title-wrap--single">
                                <h2 class="section__title section__title--small">Gift cards</h2>

                                <div class="section__nav-wrap">
                                    <a href="https://gogame.volkovdesign.com/#" class="section__view">View All</a>
                                </div>
                            </div>
                            <!-- end title -->

                            <!-- cards -->
                            <ul class="list list--mb">
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">Phantasmagoria 2: A Puzzle of Flesh</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$3.89</span><s>$5.99</s><b>35% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/6.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">Shadowrun Hong Kong - Extended Edition Deluxe Upgrade</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$4.99</span><s>$9.99</s><b>50% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/8.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">We are the Dwarves</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$2.24</span><s>$24.99</s><b>91% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                            <!-- end cards -->
                        </div>
                    </div>	
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- title -->
                            <div class="section__title-wrap section__title-wrap--single">
                                <h2 class="section__title section__title--small">Subscriptions</h2>

                                <div class="section__nav-wrap">
                                    <a href="https://gogame.volkovdesign.com/#" class="section__view">View All</a>
                                </div>
                            </div>
                            <!-- end title -->

                            <!-- cards -->
                            <ul class="list">
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/9.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">Gabriel Knight: Sins of the Fathers</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$3.89</span><s>$5.99</s><b>35% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">Unrest Special Edition</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$7.49</span><s>$24.99</s><b>70% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <a href="https://gogame.volkovdesign.com/#" class="list__cover">
                                        <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4.jpg')}}" alt="">
                                    </a>

                                    <div class="list__wrap">
                                        <h3 class="list__title">
                                            <a href="https://gogame.volkovdesign.com/#">Gabriel Knight 3: Blood of the Sacred, Blood of the Damned</a>
                                        </h3>

                                        <div class="list__price">
                                            <span>$3.89</span><s>$5.99</s><b>35% OFF</b>
                                        </div>

                                        <button class="list__buy" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                            <!-- end cards -->
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap section__title-wrap--single">
                        <h2 class="section__title">Latest news</h2>

                        <div class="section__nav-wrap">
                            <a href="https://gogame.volkovdesign.com/news.html" class="section__view">View All</a>
                        </div>
                    </div>
                </div>
                <!-- end title -->

                <!-- big post -->
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="post post--big">
                        <a href="https://gogame.volkovdesign.com/article.html" class="post__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/2(1).jpg')}}" alt="">
                        </a>

                        <div class="post__content">
                            <a href="https://gogame.volkovdesign.com/#" class="post__category">NFS</a>
                            <h3 class="post__title"><a href="https://gogame.volkovdesign.com/article.html">New hot race from your favorite computer games studio</a></h3>
                            <div class="post__meta">
                                <span class="post__date"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><polyline points="256 128 256 272 352 272" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline></svg> 2 hours ago</span>
                                <span class="post__comments"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path><path d="M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path></svg> 17</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end big post -->

                <!-- big video post -->
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="post post--big">
                        <a href="https://gogame.volkovdesign.com/interview.html" class="post__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/1(1).jpg')}}" alt="">
                        </a>

                        <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="post__video">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M112,111V401c0,17.44,17,28.52,31,20.16l247.9-148.37c12.12-7.25,12.12-26.33,0-33.58L143,90.84C129,82.48,112,93.56,112,111Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path></svg>
                        </a>

                        <div class="post__content">
                            <a href="https://gogame.volkovdesign.com/#" class="post__category">CS:GO</a>
                            <h3 class="post__title"><a href="https://gogame.volkovdesign.com/interview.html">Top 20 CS:GO players of 2020 according to HOTFLIX.tv</a></h3>
                            <div class="post__meta">
                                <span class="post__date"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><polyline points="256 128 256 272 352 272" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline></svg> 3 hours ago</span>
                                <span class="post__comments"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path><path d="M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path></svg> 11</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end big video post -->

                <!-- video post -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="post">
                        <a href="https://gogame.volkovdesign.com/interview.html" class="post__cover">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3(1).jpg')}}" alt="">
                        </a>

                        <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="post__video">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M112,111V401c0,17.44,17,28.52,31,20.16l247.9-148.37c12.12-7.25,12.12-26.33,0-33.58L143,90.84C129,82.48,112,93.56,112,111Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path></svg>
                        </a>

                        <div class="post__content">
                            <a href="https://gogame.volkovdesign.com/#" class="post__category">Overview</a>
                            <h3 class="post__title"><a href="https://gogame.volkovdesign.com/interview.html">Updated and customized gamepad</a></h3>
                            <div class="post__meta">
                                <span class="post__date"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><polyline points="256 128 256 272 352 272" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline></svg> 4 hours ago</span>
                                <span class="post__comments"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path><path d="M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path></svg> 14</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end video post -->

                <!-- post -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="post">
                        <a href="https://gogame.volkovdesign.com/article.html" class="post__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/4(1).jpg')}}" alt="">
                        </a>

                        <div class="post__content">
                            <a href="https://gogame.volkovdesign.com/#" class="post__category">PC</a>
                            <h3 class="post__title"><a href="https://gogame.volkovdesign.com/article.html">Gaming computer RXZ-3000 Ultra with revolutionary..</a></h3>
                            <div class="post__meta">
                                <span class="post__date"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><polyline points="256 128 256 272 352 272" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline></svg> 2 hours ago</span>
                                <span class="post__comments"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path><path d="M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path></svg> 18</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end post -->

                <!-- post -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="post">
                        <a href="https://gogame.volkovdesign.com/article.html" class="post__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/5(1).jpg')}}" alt="">
                        </a>

                        <div class="post__content">
                            <a href="https://gogame.volkovdesign.com/#" class="post__category">VR</a>
                            <h3 class="post__title"><a href="https://gogame.volkovdesign.com/article.html">Augmented reality (AR) and Virtual Reality (VR) bridge..</a></h3>
                            <div class="post__meta">
                                <span class="post__date"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z" style="fill:none;stroke-miterlimit:10;stroke-width:32px"></path><polyline points="256 128 256 272 352 272" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline></svg> 9 hours ago</span>
                                <span class="post__comments"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path><path d="M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11" style="fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></path></svg> 50</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end post -->
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- section -->
    <div class="section section--last">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="partners owl-carousel owl-loaded">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-1309px, 0px, 0px); transition: 0.7s; width: 3930px;">
                        <div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3docean-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/activeden-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/audiojungle-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/codecanyon-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/photodune-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/themeforest-light-background.png')}}" alt="">
                        </a></div><div class="owl-item active" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3docean-light-background.png')}}" alt="">
                        </a></div><div class="owl-item active" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/activeden-light-background.png')}}" alt="">
                        </a></div><div class="owl-item active" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/audiojungle-light-background.png')}}" alt="">
                        </a></div><div class="owl-item active" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/codecanyon-light-background.png')}}" alt="">
                        </a></div><div class="owl-item active" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/photodune-light-background.png')}}" alt="">
                        </a></div><div class="owl-item active" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/themeforest-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/3docean-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/activeden-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/audiojungle-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/codecanyon-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/photodune-light-background.png')}}" alt="">
                        </a></div><div class="owl-item cloned" style="width: 188.333px; margin-right: 30px;"><a href="https://gogame.volkovdesign.com/#" class="partners__img">
                            <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/themeforest-light-background.png')}}" alt="">
                        </a></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end section --> --}}

@endsection


@section('js')
    <script>
        
    </script>
@endsection