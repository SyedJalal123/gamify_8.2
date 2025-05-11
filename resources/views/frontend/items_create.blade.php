@extends('frontend.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/items_create.css')}}">
@endsection

@section('content')
    <!-- home -->
    <section class="section section--bg section--first" data-bg="GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg" style="background: url(&quot;GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg&quot;) center top 140px / auto 500px no-repeat;">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12 d-flex justify-content-center">
                    <form id="regForm" method="post" action="{{url('items/store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="container__top text-center">
                            <div class="title">
                                <h2>Start selling</h2>
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
                            
                        </div>
                        
                        <!-- One "tab" for each step in the form: -->
                        <div class="tab">
                            <div class="container">
                                <div class="header-container">
                                    <h4>Choose category</h4>
                                </div>
                                <div class="category-select-container">
                                    @foreach($categories as $category)
                                    <div class="category-select mb-2 category-item fade-in-delay-small-2" data-category-id="{{ $category->id }}" onclick="nextPrev(1),selectCategory({{ $category->id }})">
                                        <div class="name">
                                            <eld-image style="height: 32px;">
                                                <img class="app-image" alt="Currency"
                                                    height="32" width="32" loading="eager" fetchpriority="auto" ng-img="true"
                                                    src="{{asset('images/categ_logo.svg')}}"
                                                    >
                                            </eld-image>
                                            <h6 class="m-0 ml-2">{{ $category->name }}</h6>
                                        </div>
                                        <eld-icon name="sign-right">
                                            <span class="icon icon-sign-right" style="font-size: 32px; font-weight: 400; height: 32px; width: 32px;"></span>
                                            <i class="bi bi-chevron-right"></i>
                                        </eld-icon>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- <div id="verification-required-section" class="mt-5">
                                    <eld-sell-verification-required>
                                        <div class="verification-required-wrapper">
                                            <eld-image alt="Seller verification required photo"
                                                style="height: 79px;"><img class="app-image" alt="Seller verification required photo"
                                                    height="79" width="131" loading="eager" fetchpriority="auto" ng-img="true"
                                                    src="https://w9g7dlhw3kaank.www.eldorado.gg/j62a2GcumwfUdKP1xFHZYHorCzvyl6LgnkRxKGN3eBJ6hku/3Y6EJNl18m5bq3jzWibuFZOwBu3I0gUaRSPHr88TQM4NPO1GfRCV6RC1ULurrCqvDHzbUslFHip3DfwqRbz6UhhKvrIKcBSpbSqPQ"
                                                    srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/payments/v9/verification-required.png?w=131 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/payments/v9/verification-required.png?w=262 2x">
                                            </eld-image>
                                            <h4><span>Seller verification required</span></h4>
                                            <div class="verify-messsge">
                                                <p>To sell accounts, please verify your identity first. <br>Our 24/7 support team will review your ID in up to 15 minutes.</p>
                                                <div class="verification-card d-flex align-items-center flex-column">
                                                    <div class="container__top drop-box w-50 d-flex align-items-center flex-column">
                                                        <img class="app-image" alt="Seller Details review" height="47" width="47" loading="eager" fetchpriority="auto" ng-img="true" src="https://w9g7dlhw3kaank.www.eldorado.gg/WDlx5231QLHO4pNG8aWDLC6fwyjcgZYq1rK6yiNBBlMlTqwI5oZAqBlyRUmA07HH6oAYiZxmF6PrQLDdoG4x7M6i7mNzNoQx80fB84tuP1nmjA0kdWLI5YVxsT5YbpbXPbr" srcset="https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/id-verification.svg?w=47 1x, https://assetsdelivery.eldorado.gg/v7/_assets_/miscellaneous/v6/id-verification.svg?w=94 2x">
                                                        <strong>Seller Verification</strong>
                                                        <div role="status" tabindex="0" aria-label="Documents required">
                                                            <span class="badge badge-pill badge-danger">Documents required</span>
                                                        </div>
                                                        <button class="mt-2 btn-sm btn-success">Verify</button>
                                                    </div>
                                                </div>
                                            </div><!----><!---->
                                        </div>
                                    </eld-sell-verification-required>
                                </div> --}}
                            </div>
                        </div>
                        
                        <div class="tab_2 d-none">
                            <div class="">
                                <div class="container">
                                    <div id="games-container" class="select-2-dark" style="display: none;">
                                        <h4>Select a Game</h4>
                                        <select id="games-dropdown" name="game_id" required>
                                            <option value="">Select a Game</option>
                                        </select>
                                    </div>
                                </div>
    
                                <div style="overflow:auto;" class="d-flex justify-content-center buttons mt-5">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab_3 d-none">
                            <div class="">
                                <div class="container">
                                    <div class="attributes-container" style="display: none;">
    
                                        <h4>Game Attributes</h4>
                                        <div class="select-2-dark" id="game-attributes-list"></div>

                                    </div>
                                </div>
    
                                <div style="overflow:auto;" class="d-flex justify-content-center buttons mt-5">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab fade-in-delay-small-2">
                            <input type="hidden" name="category_id" id="selectedCategory">
                            <input type="hidden" name="category_game_id" id="category_game_id">
                            <div class="container">
                                <div class="attributes-container" style="display: none;">
                                    <div id="category-attributes-list"></div>
                                </div>
                            </div>
                            <div class="custom-container">
                                <div class="main-card currency_class accounts_class topup_class items_class">
                                
                                    <!-- Item Section -->
                                    <div class="card-section currency_class topup_class">
                                        <label class="form-label">Your item</label>
                                        <div class="d-flex align-items-center">
                                        <img src="{{ asset('uploads/games/riot-points.webp') }}" id="feature_image" alt="Game Image" style="width: 90px; height: auto; border-radius: 8px;" class="feature_image">
                                        <div class="ml-3">
                                            <div class="fw-bold small feature_details">
                                                <span>EU</span>
                                                <span>- Aegwynn</span>
                                                <span>- Horde</span>
                                            </div>
                                            <div class="text-muted small currency_class topup_class feature_currency">Gold</div>
                                            <div class="text-muted small fw-normal badge bg-info-light mt-2 w-fit topup_class feature_topup">80 Gems</div>
                                        </div>
                                        </div>
                                    </div>

                                    <!-- Offer Title -->
                                    <div class="card-section accounts_class items_class">
                                        <label class="form-label">Offer Title</label>
                                        <textarea class="form-control accounts_r items_r" id="title" name="title" required rows="2" placeholder="Type here..."></textarea>
                                        <small class="form-text">Give your item a descriptive title. What would buyers search for to find your item? Add the most searchable words at the front of your title. Titles have a 160 character limit.</small>
                                    </div>

                                    <!-- offer photo(s) -->
                                    <div class="card-section images_section accounts_class items_class">
                                        <label class="form-label">Upload offer photo(s)</label>
                                        <div class="mb-3 images_main">
                                            <!-- Button for triggering file input -->
                                            <button type="button" class="btn-sm btn-dark mb-2" id="uploadBtn">+ Add Images</button>
                                            <input type="file" id="imageInput" accept="image/*" style="display: none;">
        
                                            <div class="preview-container" id="preview"></div>
        
                                            <!-- Hidden input to store selected images -->
                                            <div id="imageInputsContainer"></div>
                                            
                                            <input type="hidden" class="accounts_r items_r" name="feature_image" id="featuredImageInput" required>
                                            <small class="form-text">Must be JPEG, PNG or HEIC and cannot exceed 10MB.</small>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Description -->
                                    <div class="card-section">
                                        <label class="form-label currency_class accounts_class items_class">Description (Optional)</label>
                                        <label class="form-label topup_class">Delivery instructions</label>
                                        <textarea class="form-control topup_r" id="description" name="description" rows="4" required placeholder="Type here..."></textarea>
                                        <small class="form-text">The listing title and description must be accurate and informative. Misleading description violates Seller Rules.</small>
                                    </div>

                                    <!-- Delivery Method -->
                                    <div class="card-section">
                                        <div class="currency topup mb-3 currency_class topup_class items_class">
                                            <label class="form-label">Guaranteed Delivery Time</label>
                                            <select class="form-select currency_r topup_r items_r" id="delivery_time" name="delivery_time" required>
                                                <option disabled selected value="">Choose Delivery Time</option>
                                                <option>20 min</option>
                                                <option>1 h</option>
                                                <option>5 h</option>
                                                <option>12 h</option>
                                                <option>1 day</option>
                                                <option>2 days</option>
                                                <option>3 days</option>
                                                <option>7 days</option>
                                                <option>14 days</option>
                                                <option>28 days</option>
                                            </select>
                                        </div>
                                        <div class="items mb-3 items_class">
                                            <label class="form-label">Delivery method</label>
                                            <input type="text" class="form-control items_r" required value="In-game delivery" disabled>
                                        </div>
                                        <div class="accounts accounts_class">
                                            <label class="form-label">Delivery method</label>
                                            <div>
                                                <input type="radio" name="deliver_method" class="w-auto" checked id="automatic_method">
                                                <label for="automatic_method">Automatic</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="deliver_method" class="w-auto" id="manual_method">
                                                <label for="manual_method">Manual</label>
                                            </div>
                                            <small class="form-text">When the buyer purchases your account, Gamify will instantly deliver the account details so you don't even have to be online!</small>
                                        </div>
                                    </div>

                                    <!-- Account Information -->
                                    <div class="card-section accounts_class">

                                        <label class="form-label">Account Information Shared With Buyer</label>
                                        <small class="form-text">
                                            You should provide all the details related to the account that might be relevant to have full ownership.
                                            <br>- Character name
                                            <br>- Login name
                                            <br>- Password
                                            <br>- Security questions and answers
                                            <br>- Any extra passwords/PIN/codes if applicable
                                            <br>- Any other relevant info
                                        </small>
                                      
                                        <!-- Default Account 1 -->
                                        <div class="account-field mt-4">
                                            <label class="form-label">Account 1</label>
                                            <textarea class="form-control accounts_r" id="account_info" name="account_info[]" rows="2" required placeholder="Type here..."></textarea>
                                        </div>
                                      
                                        <!-- Container for dynamic accounts -->
                                        <div id="additionalAccounts"></div>
                                      
                                        <button type="button" id="addAccountBtn" class="btn btn-outline-secondary btn-sm mt-3">+ Add Additional Account</button>
                                      
                                    </div>

                                    <!-- Quantity Section -->
                                    <div class="card-section currency_class topup_class items_class">
                                        <label class="form-label">Quantity</label>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <span class="small">Total Quantity Available</span>
                                                <div class="input-group">
                                                    <button class="btn btn-minus mr-1" type="button">-</button>
                                                    <input type="number" class="form-control text-center input-group-text-input currency_r topup_r items_r" id="quantity_available" required name="quantity_available" value="0" min="0" step="1">
                                                    <span class="input-group-text feature_currency_type">M</span>
                                                    <button class="btn btn-plus ml-1" type="button">+</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 currency_class items_class">
                                                <span class="small">Minimum Offer Quantity</span>
                                                <div class="input-group">
                                                    <button class="btn btn-minus mr-1" type="button">-</button>
                                                    <input type="number" class="form-control text-center input-group-text-input currency_r topup_r items_r" id="minimum_quantity" required name="minimum_quantity" value="1" min="1" step="1">
                                                    <span class="input-group-text feature_currency_type">M</span>
                                                    <button class="btn btn-plus ml-1" type="button">+</button>
                                                </div>
                                            </div>
                                            <div class="small text-danger d-none quanity_must_error">Quantity must be above or equal to Minimum Offer quantity</div>
                                        </div>
                                    </div>
                                
                                    <!-- Price Section -->
                                    <div class="card-section">
                                        <label class="form-label">Price per <span class="feature_currency__default_amount">1</span><span class="feature_currency_type">M</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control input-group-text-input" id="price" required name="price" placeholder="Price" step="any">
                                            <span class="input-group-text">$ USD</span>
                                        </div>
                                    </div>
                                
                                    <!-- Volume Discount -->
                                    <div class="card-section currency_class items_class">
                                        <label class="form-label">Volume Discount</label>
                                        <div id="discount-container">
                                            <div class="row g-2 align-items-center mb-2 discount-row" id="discount_row_0">
                                                <div class="col-md-5">
                                                    <span class="small">If user buys X or more</span>
                                                    <div class="input-group">
                                                        <button class="btn btn-minus mr-1" type="button">-</button>
                                                        <input type="number" class="form-control input-group-text-input text-center" id="discount_amont_0" name="discount_amont[]" value="0" min="0">
                                                        <span class="input-group-text feature_currency_type">M</span>
                                                        <button class="btn btn-plus ml-1" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <span class="small">Discount applied</span>
                                                    <div class="input-group">
                                                        <button class="btn btn-minus mr-1" type="button">-</button>
                                                        <input type="number" class="form-control input-group-text-input text-center" id="discount_applied_0" name="discount_applied[]" value="0" min="0" max="100">
                                                        <span class="input-group-text">%</span>
                                                        <button class="btn btn-plus ml-1" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <button type="button" class="btn btn-delete delete-row"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" id="addRow">+ Add row</button>
                                        <div class="small text-danger d-none dis_percentage_error_0">Discount percentage must be more than 0</div>
                                        <div class="small text-danger d-none dis_quantity_max_error_0">Volume Discount quantity cannot be greater than Total Quantity available</div>
                                        <div class="small text-danger d-none dis_quantity_min_error_0">Volume Discount quantity must be greater than Minimum Offer quantity</div>
                                    </div>
                                
                                    <!-- Fee Structure -->
                                    <div class="card-section">
                                        <label class="form-label">Fee Structure</label>
                                        <div class="p-3 bg-light rounded">
                                        <div class="small">Flat fee (per purchase): <strong>$0.00 USD</strong></div>
                                        <div class="small">Percentage fee (per purchase): <strong>5% of Price</strong></div>
                                        </div>
                                    </div>
                              
                                    <!-- Terms and Place Offer -->
                                    <div class="py-2 fs-14">
                                        <div class="form-check mb-2">
                                            <input class="w-auto form-check-input" type="checkbox" id="termsService" name="termsService" required>
                                            <label class="form-check-label" for="termsService">
                                                I have read and agree to the <a href="#">Terms of Service</a>.
                                            </label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="w-auto form-check-input" type="checkbox" id="sellerRules" name="sellerRules" required>
                                            <label class="form-check-label" for="sellerRules">
                                                I have read and agree to the <a href="#">Seller Rules</a>.
                                            </label>
                                        </div>
                                        <div class="text-danger small rules_error d-none">You must agree with the seller policy and Terms of Service</div>

                                        <button id="nextBtn" type="button" class="btn btn-dark w-100 mt-3" onclick="nextPrev(1)">Place Offer</button>
                                    </div>
                              
                                </div>
                                <div class="boosting_class">
                                    <div class="container">
                                        <p class="text-center text-black-40">
                                            Select the services you can provide to receive notifications from the buyers
                                        </p>
                                        {{-- <p class="text-center"><a href="#" class="text-decoration-none">How it works</a></p> --}}
                                        <div class="mt-2">
                                            @foreach ($categories[4]->categoryGames as $key => $item)
                                                @php $count = 0; $total = 0; 
                                                    foreach ($item->services as $service) {
                                                        if(optional(auth()->user()->services)->contains($service->id)) $count++; $total++;
                                                    }
                                                @endphp  
                                                <div class="card bg-light-dark2 mt-3">
                                                    <div class="card-header d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#serviceOptions_{{$key}}" aria-expanded="false" aria-controls="serviceOptions">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{asset($item->game->image)}}" alt="Apex" width="35" height="35" class="rounded mr-3">
                                                            <div>
                                                                <div class="font-weight-bold">{{$item->game->name}}</div>
                                                                @if($count > 0)
                                                                <div class="text-success subscription-data-{{$key}} small">Subscribed {{$count}}/{{$total}}</div>
                                                                @else
                                                                <div class="text-muted subscription-data-{{$key}} small">Not Subscribed</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <i class="arrow-icon bi bi-chevron-down"></i>
                                                    </div>
        
                                                    <div class="collapse" id="serviceOptions_{{$key}}">
                                                        <ul class="list-group list-group-flush">
                                                            @foreach ($item->services as $key2 => $service)
                                                            <li class="list-group-item service-label">
                                                                {{$service->name}}
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" onchange="toggleService(this)"
                                                                        {{ optional(auth()->user()->services)->contains($service->id) ? 'checked' : '' }}
                                                                        class="custom-control-input service-toggle" 
                                                                        data-service-id="{{ $service->id }}" 
                                                                        data-total-avaliable="{{ $total }}" 
                                                                        data-key="{{ $key }}" 
                                                                        id="service_{{$key}}_{{$key2}}">
                                                                    <label class="custom-control-label" for="service_{{$key}}_{{$key2}}"></label>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="overflow:auto;" class="d-flex justify-content-center buttons mt-5">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                                </div>
                            </div>
                        </div> 
                        
                        <!-- Circles which indicates the steps of the form: -->
                        <div class="steps-container" style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        
                    </form>
                </div>
                <!-- end title -->
            </div>
        </div>
    </section>
    <!-- end home --> 
@endsection


@section('js')
    {{-- Step form script --}}
    <script src="{{asset('js/items_create.js')}}"></script>       
@endsection































{{-- @extends('frontend.app')

@section('content')

    <div class="container section section--first text-white text-center pb-5 mb-5">
        <h2>Upload New Item</h2>
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <input type="hidden" name="category_id" value="{{ $categoryId }}">
            <input type="hidden" name="game_id" value="{{ $gameId }}">
    
            <div class="mb-3">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
    
            <div class="mb-3">
                <label>Price:</label>
                <input type="number" name="price" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label>Delivery Type:</label>
                <select name="delivery_type" class="form-control" required>
                    <option value="instant">Instant</option>
                    <option value="manual">Manual</option>
                </select>
            </div>
    
            <div class="mb-3">
                <label>Upload Images:</label>
                <input type="file" id="imageInput" name="images[]" class="form-control" multiple onchange="event.preventDefault();">
            </div>
        
            <!-- Image Preview Section -->
            <div id="imagePreviewContainer" class="d-flex flex-wrap"></div>
        
            <!-- Hidden input for feature image -->
            <input type="hidden" name="feature_image" id="featureImageInput">

    
            <button type="submit" class="btn btn-primary">Upload Item</button>
        </form>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedFiles = []; // Store selected files
        let featureImageName = null; // Track feature image

        document.getElementById('imageInput').addEventListener('change', function(event) {
            let files = Array.from(event.target.files);
            let previewContainer = document.getElementById('imagePreviewContainer');

            files.forEach(file => {
                if (!selectedFiles.some(f => f.name === file.name)) { // Avoid duplicate images
                    selectedFiles.push(file);

                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('image-wrapper');
                        imageWrapper.style.position = 'relative';
                        imageWrapper.style.margin = '10px';
                        imageWrapper.style.display = 'inline-block';
                        imageWrapper.style.border = '2px solid transparent';

                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.dataset.filename = file.name;

                        // Feature Image Tag
                        let featureTag = document.createElement('div');
                        featureTag.innerText = 'Feature';
                        featureTag.classList.add('feature-tag');
                        featureTag.style.position = 'absolute';
                        featureTag.style.top = '5px';
                        featureTag.style.left = '5px';
                        featureTag.style.background = 'gold';
                        featureTag.style.color = 'black';
                        featureTag.style.padding = '2px 5px';
                        featureTag.style.borderRadius = '5px';
                        featureTag.style.display = 'none'; // Hidden by default

                        // Feature Image Button
                        let featureButton = document.createElement('button');
                        featureButton.innerText = 'Set Feature';
                        featureButton.type = 'button';
                        featureButton.style.position = 'absolute';
                        featureButton.style.bottom = '5px';
                        featureButton.style.left = '5px';
                        featureButton.style.background = 'green';
                        featureButton.style.color = 'white';
                        featureButton.style.border = 'none';
                        featureButton.style.cursor = 'pointer';
                        featureButton.addEventListener('click', function() {
                            setFeatureImage(file.name, imageWrapper, featureTag);
                        });

                        // Remove Button
                        let removeButton = document.createElement('button');
                        removeButton.innerText = 'X';
                        removeButton.style.position = 'absolute';
                        removeButton.style.top = '5px';
                        removeButton.style.right = '5px';
                        removeButton.style.background = 'red';
                        removeButton.style.color = 'white';
                        removeButton.style.border = 'none';
                        removeButton.style.cursor = 'pointer';
                        removeButton.addEventListener('click', function() {
                            selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                            
                            // If the removed image was the feature image, reset feature selection
                            if (featureImageName === file.name) {
                                document.getElementById('featureImageInput').value = ''; // Reset feature image
                                featureImageName = null;

                                // Set the first remaining image as the new feature image
                                if (selectedFiles.length > 0) {
                                    let firstImageWrapper = previewContainer.querySelector('.image-wrapper');
                                    let firstFeatureTag = firstImageWrapper.querySelector('.feature-tag');
                                    let firstImageName = selectedFiles[0].name;
                                    setFeatureImage(firstImageName, firstImageWrapper, firstFeatureTag);
                                }
                            }

                            imageWrapper.remove();
                        });

                        imageWrapper.appendChild(img);
                        imageWrapper.appendChild(featureTag);
                        imageWrapper.appendChild(featureButton);
                        imageWrapper.appendChild(removeButton);
                        previewContainer.appendChild(imageWrapper);

                        // Automatically set the first image as the feature image
                        if (selectedFiles.length === 1) {
                            setFeatureImage(file.name, imageWrapper, featureTag);
                        }
                    };

                    reader.readAsDataURL(file);
                }
            });

            // Reset the file input to allow re-selection of the same file
            event.target.value = '';
        });

        function setFeatureImage(imageName, imageWrapper, featureTag) {
            // Remove highlight from all images
            document.querySelectorAll('.image-wrapper').forEach(el => {
                el.style.border = '2px solid transparent';

                // Hide previous feature tag
                let prevFeatureTag = el.querySelector('.feature-tag');
                if (prevFeatureTag) prevFeatureTag.style.display = 'none';
            });

            // Highlight selected feature image
            imageWrapper.style.border = '2px solid gold';
            featureTag.style.display = 'block';

            // Store feature image filename
            document.getElementById('featureImageInput').value = imageName;
            featureImageName = imageName;
        }
    });
</script>
    
    
@endsection --}}