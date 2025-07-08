@extends('frontend.app')

@section('css')
    <style>
        .section--first {
            padding-top: 144px !important;
        }

        .d-none {
            display: none !important;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }

            .d-md-block {
                display: block !important;
            }
        }

        .dt-search {
            display: none !important;
        }
        .dt-layout-row, .dt-paging-button {
            color: var(--text-primary) !important;
        }

        div.dt-container .dt-paging .dt-paging-button.disabled, div.dt-container .dt-paging .dt-paging-button.disabled:hover, div.dt-container .dt-paging .dt-paging-button.disabled:active {
            color: var(--text-secondary) !important;
        }

        .card-section {
            background: var(--background-body-1);
            color: var(--text-primary);
            border: 1px solid var(--border-1);
            padding: 20px;
            margin-bottom: 10px;
        }
        

        .preview-container { display: flex; flex-wrap: wrap; gap: 9px; }
        .image-wrapper { position: relative; display: inline-block; }
        .image-wrapper img { width: 100px; cursor: pointer; border: 3px solid transparent; }
        .image-wrapper .remove-btn { 
            position: absolute; top: 0; right: 0; background: red; color: white; 
            border: none; cursor: pointer; padding: 2px 5px; font-size: 12px; 
        }
        .featured { border: 3px solid gold !important; }
        .featured-tag { 
            position: absolute; bottom: 5px; left: 5px; background: gold; color: black; 
            padding: 3px 5px; font-size: 12px; font-weight: bold; border-radius: 3px;
        }

        .btn-delete {
            background-color: #dc3545;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            background-color: #ffffff;
            border: 1px solid #dc3545;
        }
        .btn-delete:hover i {
            color: #dc3545;
        }
        .btn-delete i {
            font-size: 18px;
            color: #fff;
            transition: color 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <section class="section section--bg section--first"  style="background: url('{{ asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/img/bg.jpg') }}') center top 140px / auto 500px no-repeat;">
        <div class="row m-0 position-relative zi-2">
            <div class="d-none d-lg-block col-md-2 p-0">
                @include('frontend.includes.sidebar')
            </div>
    
            <div class="col-md-12 col-lg-10 pt-5">
                <div class="row">
                    <form action="{{ route('items.update') }}" method="POST" id="update-form" class="col-12" enctype="multipart/form-data">
                        @csrf
                        <div class="main-card" style="max-width: 768px;">
                            <div>
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
                            
                            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                            <input type="hidden" name="category_id" id="selectedCategory" value="{{ $categoryId }}">
                            <input type="hidden" name="category_game_id" id="category_game_id" value="{{ $offer->category_game_id }}">

                            <!-- Item Section -->
                            <div class="card-section {{ !in_array($categoryId, [1, 3]) ? 'd-none' : '' }}">
                                <label class="form-label">Your item</label>
                                <div class="d-flex align-items-center">
                                 <img src="{{ asset($offer->categoryGame->feature_image != null ? $offer->categoryGame->feature_image : $offer->images_path.$offer->feature_image) }}" id="feature_image" alt="Game Image" style="width: 90px; height: auto; border-radius: 8px;" class="feature_image">
                                <div class="ml-3">
                                    @php $topup_value = null; @endphp
                                    <div class="fw-bold small feature_details">
                                        @foreach ($offer->attributes as $key => $attribute)
                                            {{-- {{dd($offer->attributes)}} --}}
                                            @php if($attribute->topup == 1) {$topup_value = $attribute->pivot->value;} $countr = 0; @endphp
                                            @if ($attribute->applies_to == 1 && $attribute->topup == 0)
                                                <span>@if ($countr !== 0)-@endif {{ $attribute->pivot->value }}</span>
                                                @php $countr++; @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="text-muted small currency_class {{ !in_array($categoryId, [1, 3]) ? 'd-none' : '' }}">{{ $offer->categoryGame->title }}</div>
                                    <div class="btn-theme-pill-default small fw-normal badge mt-2 w-fit {{ !in_array($categoryId, [3]) ? 'd-none' : '' }} feature_topup">{{ $topup_value }} {{ $offer->categoryGame->title }}</div>
                                </div>
                                </div>
                            </div>

                            <!-- Offer Title -->
                            <div class="card-section {{ !in_array($categoryId, [2, 4]) ? 'd-none' : '' }}">
                                <label class="form-label">Offer Title</label>
                                <textarea class="form-control auto-resize-textarea resize-none overflow-hidden scroll-bar-theme-bg-card input-theme-1" id="title" name="title" rows="2" placeholder="Type here..." {{ in_array($categoryId, [2, 4]) ? 'required' : '' }}>{{ $offer->title }}</textarea>
                                <small class="form-text">Give your item a descriptive title. What would buyers search for to find your item? Add the most searchable words at the front of your title. Titles have a 160 character limit.</small>
                            </div>

                            <!-- offer photo(s) -->
                            <div class="card-section images_section {{ !in_array($categoryId, [2, 4]) ? 'd-none' : '' }}">
                                <label class="form-label">Upload offer photo(s)</label>
                                <div class="mb-3 images_main">
                                    <!-- Button for triggering file input -->
                                    <button type="button" class="btn-sm btn-dark mb-2" id="uploadBtn">+ Add Images</button>
                                    <input type="file" id="imageInput" accept="image/*" style="display: none;">

                                    <div class="preview-container" id="preview">
                                        @if ($offer->feature_image != null)    
                                            @foreach (json_decode($offer->images, true) as $image)    
                                                <div class="image-wrapper">
                                                    <img src="{{ asset($offer->images_path) }}/thumbnails/{{$image}}" data-filename="{{ $image }}" class="{{ $offer->feature_image == $image ? 'featured' : '' }}">
                                                    <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                    <div class="{{ $offer->feature_image !== $image ? 'd-none' : '' }} featured-tag">FEATURED</div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <!-- Hidden input to store selected images -->
                                    <div id="imageInputsContainer"></div>
                                    <input type="hidden" class="" name="feature_image" value="{{ $offer->feature_image }}" id="featuredImageInput" {{ in_array($categoryId, [2, 4]) ? 'required' : '' }}>
                                    <small class="form-text">Must be JPEG, PNG or HEIC and cannot exceed 10MB.</small>
                                </div>
                            </div>
                            
                            <!-- Description -->
                            <div class="card-section">
                                <label class="form-label {{ !in_array($categoryId, [1, 2, 4]) ? 'd-none' : '' }}">Description (Optional)</label>
                                <label class="form-label {{ !in_array($categoryId, [3]) ? 'd-none' : '' }}">Delivery instructions</label>
                                <textarea class="form-control auto-resize-textarea resize-none overflow-hidden input-theme-1" id="description" name="description" rows="4" placeholder="Type here..." {{ in_array($categoryId, [3]) ? 'required' : '' }}>{{ $offer->description }}</textarea> 
                                <small class="form-text">The listing title and description must be accurate and informative. Misleading description violates Seller Rules.</small>
                            </div>

                            <!-- Delivery Method -->
                            <div class="card-section">
                                <div class="accounts {{ !in_array($categoryId, [2]) ? 'd-none' : '' }}">
                                    <label class="form-label">Delivery method</label>
                                    <div>
                                        <input type="radio" name="delivery_method" value="automatic" class="w-auto" {{ $offer->delivery_method == 'automatic' ? 'checked' : '' }} id="automatic_method">
                                        <label for="automatic_method">Automatic</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="delivery_method" value="manual" class="w-auto" {{ $offer->delivery_method == 'automatic' ? '' : 'checked' }} id="manual_method">
                                        <label for="manual_method">Manual</label>
                                    </div>
                                </div>
                                <div id="manual_method_show" class="select-2-dark currency topup mb-3" style="{{ $offer->delivery_method == 'automatic' ? 'display:none;' : '' }}">
                                    <label class="form-label">Guaranteed Delivery Time</label>
                                    <select class="form-select currency_r" id="delivery_time" name="delivery_time"  {{ in_array($categoryId, [3, 4]) ? 'required' : '' }}>
                                        <option disabled selected value="">Choose Delivery Time</option>
                                        <option {{ $offer->delivery_time == '20 min' ? 'selected' : '' }} >20 min</option>
                                        <option {{ $offer->delivery_time == '1 h' ? 'selected' : '' }} >1 h</option>
                                        <option {{ $offer->delivery_time == '5 h' ? 'selected' : '' }} >5 h</option>
                                        <option {{ $offer->delivery_time == '12 h' ? 'selected' : '' }} >12 h</option>
                                        <option {{ $offer->delivery_time == '1 day' ? 'selected' : '' }} >1 day</option>
                                        <option {{ $offer->delivery_time == '2 days' ? 'selected' : '' }} >2 days</option>
                                        <option {{ $offer->delivery_time == '3 days' ? 'selected' : '' }} >3 days</option>
                                        <option {{ $offer->delivery_time == '7 days' ? 'selected' : '' }} >7 days</option>
                                        <option {{ $offer->delivery_time == '14 days' ? 'selected' : '' }} >14 days</option>
                                        <option {{ $offer->delivery_time == '28 days' ? 'selected' : '' }} >28 days</option>
                                    </select>
                                </div>
                                <div class="items mb-3 {{ !in_array($categoryId, [4]) ? 'd-none' : '' }}">
                                    <label class="form-label">Delivery method</label>
                                    <input type="text" class="form-control input-theme-1 items_r" required value="In-game delivery" disabled>
                                </div>
                                <small class="form-text accounts {{ !in_array($categoryId, [2]) ? 'd-none' : '' }}">When the buyer purchases your account, Gamify will instantly deliver the account details so you don't even have to be online!</small>
                            </div>

                            <!-- Account Information -->
                            <div class="card-section {{ !in_array($categoryId, [2]) || (in_array($categoryId, [2]) && $offer->delivery_method == 'manual') ? 'd-none' : '' }}" id="accounts_section">

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
                                @if ($offer->account_info != null)    
                                    @php $n = 1; @endphp
                                    @foreach ($offer->account_info as $key => $info) 
                                        <div class="@if($info['sold'] == 'no') account-field mt-4 position-relative @else d-none @endif">
                                            <label class="form-label">Account {{ $n }}</label>
                                            @if ($n !== 1)
                                            <button type="button" class="btn-delete btn-remove-account" style="position:absolute;top:0;right:0;"><i class="bi bi-trash"></i></button>
                                            @endif
                                            <textarea class="form-control auto-resize-textarea resize-none overflow-hidden input-theme-1" id="account_info" name="account_info[]" rows="2" placeholder="Type here..." {{ in_array($categoryId, [2]) ? 'required' : '' }}>{{ $info['info'] }}</textarea>
                                            <input type="hidden" name="account_id[]" value="{{ $info['id'] }}">
                                            <input type="hidden" name="account_sold[]" value="{{ $info['sold'] }}">
                                        </div>
                                        @php if($info['sold'] == 'no'){ $n++; } @endphp
                                    @endforeach
                                @endif
                                
                                <!-- Container for dynamic accounts -->
                                <div id="additionalAccounts"></div>
                                
                                <button type="button" id="addAccountBtn" class="btn btn-outline-secondary btn-sm mt-3">+ Add Additional Account</button>
                                
                            </div>

                            <!-- Quantity Section -->
                            <div class="card-section {{ !in_array($categoryId, [1, 3, 4]) && $offer->delivery_method == 'automatic' ? 'd-none' : '' }}" id="quantity_section">
                                <label class="form-label">Quantity</label>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <span class="small">Total Quantity Available</span>
                                        <div class="input-group">
                                            <button class="px-3 btn-theme-default mr-1" onclick="btnMinus('quantity_available')" type="button">-</button>
                                            <div class="tag-input-container-buttons">
                                                <div class="input-tag-1 input-tag"></div>
                                                <input type="number" class="tag-input input-theme-1 text-center input-group-text-input no-spinner" id="quantity_available" required name="quantity_available" value="{{ $offer->quantity_available }}" min="0" step="1" {{ in_array($categoryId, [1, 3, 4]) ? 'required' : '' }}>
                                                <div class="input-tag-2 feature_currency_type input-tag">{{ $offer->categoryGame->currency_type != null || $offer->categoryGame->currency_type != "" ? $offer->categoryGame->currency_type : 'unit' }}</div>
                                            </div>
                                            <button class="px-3 btn-theme-default ml-1" onclick="btnPlus('quantity_available')" type="button">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 {{ !in_array($categoryId, [1, 4]) ? 'd-none' : '' }}">
                                        <span class="small">Minimum Offer Quantity</span>
                                        <div class="input-group">
                                            <button class="px-3 btn-theme-default mr-1" onclick="btnMinus('minimum_quantity')" type="button">-</button>
                                            <div class="tag-input-container-buttons">
                                                <div class="input-tag-1 input-tag"></div>
                                                <input type="number" class="tag-input input-theme-1 text-center input-group-text-input" id="minimum_quantity" required name="minimum_quantity" value="{{ $offer->minimum_quantity }}" min="1" step="1" {{ in_array($categoryId, [1, 3, 4]) ? 'required' : '' }}>
                                                <div class="input-tag-2 feature_currency_type input-tag">{{ $offer->categoryGame->currency_type != null || $offer->categoryGame->currency_type != "" ? $offer->categoryGame->currency_type : 'unit' }}</div>
                                            </div>
                                            <button class="px-3 btn-theme-default ml-1" onclick="btnPlus('minimum_quantity')" type="button">+</button>
                                        </div>
                                    </div>
                                    <div class="small text-danger d-none quanity_must_error">Quantity must be above or equal to Minimum Offer quantity</div>
                                </div>
                            </div>
                        
                            <!-- Price Section -->
                            <div class="card-section">
                                <label class="form-label">Price per <span class="feature_currency__default_amount">1</span><span class="feature_currency_type">{{ $offer->categoryGame->currency_type != null || $offer->categoryGame->currency_type != "" ? $offer->categoryGame->currency_type : 'unit' }}</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control input-theme-1 input-group-text-input" id="price" required name="price" placeholder="Price" value="{{ $offer->price }}" step="any">
                                    <span class="input-group-text-theme-1">$ USD</span>
                                </div>
                            </div>
                        
                            <!-- Volume Discount -->
                            <div class="card-section {{ !in_array($categoryId, [1, 4]) ? 'd-none' : '' }}">
                                <label class="form-label">Volume Discount</label>
                                <div id="discount-container">
                                    @if ($offer->discount != null)    
                                        @foreach (json_decode($offer->discount, true) as $key => $discount)
                                            <div class="row g-2 align-items-end mb-2 discount-row" id="discount_row_{{ $key }}">
                                                <div class="col-md-5">
                                                    @if($key == 0)
                                                    <span class="small">If user buys X or more</span>
                                                    @endif
                                                    <div class="input-group">
                                                        <button class="px-3 btn-theme-default mr-1" onclick="btnMinus('discount_amont_{{ $key }}')" type="button">-</button>
                                                        <div class="tag-input-container-buttons">
                                                            <div class="input-tag-1 input-tag"></div>
                                                            <input type="number" class="tag-input input-theme-1 input-group-text-input text-center" value="{{ $discount['amount'] }}" id="discount_amont_{{ $key }}" name="discount_amont[]" value="0" min="0">
                                                            <div class="input-tag-2 feature_currency_type input-tag">{{ $offer->categoryGame->currency_type != null || $offer->categoryGame->currency_type != "" ? $offer->categoryGame->currency_type : 'unit' }}</div>
                                                        </div>
                                                        <button class="px-3 btn-theme-default ml-1" onclick="btnPlus('discount_amont_{{ $key }}')" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    @if($key == 0)
                                                    <span class="small">Discount applied</span>
                                                    @endif
                                                    <div class="input-group">
                                                        <button class="px-3 btn-theme-default mr-1" onclick="btnMinus('discount_applied_{{ $key }}')" type="button">-</button>
                                                        <div class="tag-input-container-buttons">
                                                            <div class="input-tag-1 input-tag"></div>
                                                            <input type="number" class="tag-input input-theme-1 input-group-text-input text-center" value="{{ $discount['discount_percentage'] }}" id="discount_applied_{{ $key }}" name="discount_applied[]" value="0" min="0" max="100">
                                                            <span class="input-tag-2 input-tag">%</span>
                                                        </div>
                                                        <button class="px-3 btn-theme-default ml-1" onclick="btnPlus('discount_applied_{{ $key }}')" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pt-2 pt-md-0">
                                                    <span class="delete-row d-md-none text-theme-marine">Remove discount</span>
                                                    <button type="button" class="btn btn-danger btn-delete delete-row d-none d-md-block"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm mt-2" id="addRow">+ Add row</button>
                                <div class="small text-danger d-none dis_percentage_error_0">Discount percentage must be more than 0</div>
                                <div class="small text-danger d-none dis_quantity_max_error_0">Volume Discount quantity cannot be greater than Total Quantity available</div>
                                <div class="small text-danger d-none dis_quantity_min_error_0">Volume Discount quantity must be greater than Minimum Offer quantity</div>
                            </div>
                        
                            <!-- Fee Structure -->
                            <div class="card-section">
                                <label class="form-label">Fee Structure</label>
                                <div class="p-3 text-theme-primary rounded">
                                    <div class="small">Flat fee (per purchase): <strong>$0.00 USD</strong></div>
                                    <div class="small">Percentage fee (per purchase): <strong>5% of Price</strong></div>
                                </div>
                            </div>
                        
                            <!-- Terms and Place Offer -->
                            <div class="py-2 fs-14 text-theme-primary mb-5">
                                <div class="form-check mb-2">
                                    <input class="w-auto form-check-input" type="checkbox" id="termsService" name="termsService" checked required>
                                    <label class="form-check-label" for="termsService">
                                        I have read and agree to the <a href="#">Terms of Service</a>.
                                    </label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="w-auto form-check-input" type="checkbox" id="sellerRules" name="sellerRules" checked required>
                                    <label class="form-check-label" for="sellerRules">
                                        I have read and agree to the <a href="#">Seller Rules</a>.
                                    </label>
                                </div>
                                <div class="text-danger small rules_error d-none">You must agree with the seller policy and Terms of Service</div>

                                <div class="d-flex">
                                    <a wire:navigate href="{{ url()->previous() }}" type="button" class="btn btn-dark mt-3 mr-3">Back</a>
                                    <button id="nextBtn" type="button" class="btn btn-success mt-3" onclick="submitForm('update-form')">Place Offer</button>
                                </div>
                            </div>
                        
                        </div>
                    </form>
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
            $('select').select2({
                dropdownPosition: 'below',
            });

            setTimeout(() => {
                $('.skeleton-overlay-start').remove();
            }, 700);
            
            if (!window.selectedFiles) {
                window.selectedFiles = [];
            }

            document.getElementById('uploadBtn').addEventListener('click', function() {
                document.getElementById('imageInput').click();
            });
            
            document.getElementById('imageInput').addEventListener('change', function(event) {
                let preview = document.getElementById('preview');
                let imageInputsContainer = document.getElementById('imageInputsContainer');
                let featuredImageInput = document.getElementById('featuredImageInput');

                if (event.target.files.length > 0) {
                    let file = event.target.files[0];

                    if (!selectedFiles.some(f => f.name === file.name)) { // Prevent duplicate uploads
                        let reader = new FileReader();

                        reader.onload = function(e) {
                            let imageWrapper = document.createElement('div');
                            imageWrapper.classList.add('image-wrapper');

                            let img = document.createElement('img');
                            img.src = e.target.result;
                            img.dataset.filename = file.name;

                            // Remove Button
                            let removeBtn = document.createElement('button');
                            removeBtn.innerText = 'X';
                            removeBtn.classList.add('remove-btn');
                            removeBtn.onclick = function() {
                                preview.removeChild(imageWrapper);
                                selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                                document.getElementById(file.name).remove();

                                // Update featured image if removed
                                if (featuredImageInput.value === file.name) {
                                    if (selectedFiles.length > 0) {
                                        featuredImageInput.value = selectedFiles[0].name;
                                        updateFeaturedImage(selectedFiles[0].name);
                                    } else {
                                        featuredImageInput.value = '';
                                    }
                                }
                            };

                            // Click to Set Featured Image
                            img.onclick = function() {
                                updateFeaturedImage(file.name);
                            };

                            imageWrapper.appendChild(img);
                            imageWrapper.appendChild(removeBtn);
                            preview.appendChild(imageWrapper);

                            selectedFiles.push(file);

                            // Create hidden input field for each image
                            let input = document.createElement('input');
                            input.type = 'file';
                            input.name = 'images[]';
                            input.id = file.name;
                            input.files = event.target.files;
                            input.style.display = 'none';
                            imageInputsContainer.appendChild(input);

                            // Auto-set first image as featured
                            if (selectedFiles.length === 1) {
                                updateFeaturedImage(file.name);
                            }
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });

            // Support for pre-rendered images
            document.querySelectorAll('.image-wrapper img').forEach(img => {
                let filename = img.dataset.filename;

                // Set click to update featured image
                img.onclick = function () {
                    updateFeaturedImage(filename);
                };

                // Add remove button if it doesn't exist already
                if (!img.parentElement.querySelector('.remove-btn')) {
                    let removeBtn = document.createElement('button');
                    removeBtn.innerText = 'X';
                    removeBtn.classList.add('remove-btn');
                    removeBtn.onclick = function () {
                        img.parentElement.remove();
                        selectedFiles = selectedFiles.filter(f => f.name !== filename);

                        if (featuredImageInput.value === filename) {
                            if (selectedFiles.length > 0) {
                                updateFeaturedImage(selectedFiles[0].name);
                            } else {
                                featuredImageInput.value = '';
                            }
                        }
                    };
                    img.parentElement.appendChild(removeBtn);
                }

                // Optionally populate selectedFiles array if needed
                if (!selectedFiles.some(f => f.name === filename)) {
                    selectedFiles.push({ name: filename }); // Mock file object
                }
            });

            function updateFeaturedImage(filename) {
                document.querySelectorAll('.image-wrapper img').forEach(i => i.classList.remove('featured'));
                document.querySelectorAll('.featured-tag').forEach(tag => tag.remove());

                let featuredImg = document.querySelector(`.image-wrapper img[data-filename="${filename}"]`);
                if (featuredImg) {
                    featuredImg.classList.add('featured');
                    document.getElementById('featuredImageInput').value = filename;

                    let tag = document.createElement('div');
                    tag.classList.add('featured-tag');
                    tag.innerText = 'FEATURED';
                    featuredImg.parentElement.appendChild(tag);
                }
            }

            document.getElementById('addRow').addEventListener('click', function() {
                const lastDiscountRow = document.querySelector('.discount-row:last-child');

                if (lastDiscountRow && lastDiscountRow.id) {
                    const idParts = lastDiscountRow.id.split('_');
                    var lastNumber = parseInt(idParts[2], 10) + 1;
                } else {
                    var lastNumber = 0;
                }

                var currency_type = $('.feature_currency_type').first().text();
                const container = document.getElementById('discount-container');
                const row = document.createElement('div');
                row.className = 'row g-2 align-items-center mb-2 discount-row';
                row.id = `discount_row_${lastNumber}`;

                row.innerHTML = `
                    <div class="col-md-5">
                        <div class="input-group">
                            <button class="px-3 btn-theme-default mr-1" onclick="btnMinus('discount_amont_${lastNumber}')" type="button">-</button>
                            <div class="tag-input-container-buttons">
                                <div class="input-tag-1 input-tag"></div>
                                <input type="number" class="tag-input input-theme-1 text-center input-group-text-input" id="discount_amont_${lastNumber}" name="discount_amont[]" value="0" min="0">
                                <div class="input-tag-2 input-tag">${currency_type}</div>
                            </div>
                            <button class="px-3 btn-theme-default ml-1" onclick="btnPlus('discount_amont_${lastNumber}')" type="button">+</button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <button class="px-3 btn-theme-default mr-1" onclick="btnMinus('discount_applied_${lastNumber}')" type="button">-</button>
                            <div class="tag-input-container-buttons">
                                <div class="input-tag-1 input-tag"></div>
                                <input type="number" class="tag-input input-theme-1 text-center input-group-text-input" id="discount_applied_${lastNumber}" name="discount_applied[]" value="0" min="0" max="100">
                                <div class="input-tag-2 input-tag">%</div>
                            </div>
                            <button class="px-3 btn-theme-default ml-1" onclick="btnPlus('discount_applied_${lastNumber}')" type="button">+</button>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <button type="button" class="btn btn-delete delete-row"><i class="bi bi-trash"></i></button>
                    </div>
                    <div class="small text-danger d-none dis_percentage_error_${lastNumber}">Discount percentage must be more than 0</div>
                    <div class="small text-danger d-none dis_quantity_max_error_${lastNumber}">Volume Discount quantity cannot be greater than Total Quantity available</div>
                    <div class="small text-danger d-none dis_quantity_min_error_${lastNumber}">Volume Discount quantity must be greater than Minimum Offer quantity</div>
                `;
                container.appendChild(row);
                updatePlusMinus();
            });

            // Accounts Script
            if (!window.accountCounter) {    
                window.accountCounter = document.querySelectorAll('.account-field').length;
            }

            $('#addAccountBtn').click(function() {
                accountCounter++;
                const newAccount = `
                    <div class="account-field mt-4 position-relative">
                    <label class="form-label">Account ${accountCounter}</label>
                    <button type="button" class="btn-delete btn-remove-account" style="position:absolute;top:0;right:0;">
                        <i class="bi bi-trash"></i>
                    </button>
                    <textarea class="input-theme-1 auto-resize-textarea resize-none overflow-hidden form-control" name="account_info[]" rows="2" placeholder="Type here..."></textarea>
                    </div>
                `;

                $('#additionalAccounts').append(newAccount);

                const textareas = document.querySelectorAll('.auto-resize-textarea');
                textareas.forEach(textarea => {
                    autoResize(textarea); // Resize on load
                    textarea.addEventListener('input', () => autoResize(textarea)); // Resize on input
                });
            });

            $(document).on('click', '.btn-remove-account', function() {
                $(this).closest('.account-field').remove();
            });

            const manualMethodRadio = document.getElementById('manual_method');
            const automaticMethodRadio = document.getElementById('automatic_method');
            const manualSection = document.getElementById('manual_method_show');

            manualMethodRadio.addEventListener('click', () => {
                manualSection.style.display = 'block'; // Show
                $('#quantity_section').removeClass('d-none');
                $('#accounts_section').addClass('d-none');

                $(`#accounts_section textarea`)[0].removeAttribute('required', 'required');
                $('#delivery_time').attr('required', 'required');
                $('#quantity_available').attr('required', 'required');

            });

            automaticMethodRadio.addEventListener('click', () => {
                manualSection.style.display = 'none'; // Hide
                $('#quantity_section').addClass('d-none');
                $('#accounts_section').removeClass('d-none');

                $(`#accounts_section textarea`)[0].setAttribute('required', 'required');
                $('#delivery_time').removeAttr('required', 'required');
                $('#quantity_available').removeAttr('required', 'required');

                const textareas = document.querySelectorAll('.auto-resize-textarea');
                setTimeout(function() {
                    textareas.forEach(textarea => {
                        autoResize(textarea); // Resize on load
                        textarea.addEventListener('input', () => autoResize(textarea)); // Resize on input
                    });
                }, 10);
            });
        }

        function submitForm(id) {
            if(validateForm() == true && validateForm2() == true){
                $(`#${id}`).submit();
            }
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("section");
            y = x[0].getElementsByTagName("input");
            var checkboxes = Array.from(y).filter(input => input.type === 'checkbox');
            var y = Array.from(y).filter(input => input.type !== 'checkbox');
            z = x[0].getElementsByTagName("select");
            t = x[0].getElementsByTagName("textarea");

            // checkboxes
            for (i = 0; i < checkboxes.length; i++) {
                // If a field is empty...
                if ($(checkboxes[i]).attr('required') && $(checkboxes[i]).attr('type') == 'checkbox' && !$(checkboxes[i]).is(':checked')) {
                    if(checkboxes[i].name == 'termsService' || checkboxes[i].name == 'sellerRules'){
                        $('.rules_error').removeClass("d-none");
                    }
                    valid = false;
                }else if($(checkboxes[i]).attr('required')){
                    $('.rules_error').addClass("d-none");
                }
            }
            // inputs
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "" && $(y[i]).attr('required')) {
                    y[i].classList.add("invalid");
                    valid = false;

                    if (y[i].name == "feature_image") {
                        $('.images_section').addClass("invalid");
                    }
                }else {
                    y[i].classList.remove("invalid");

                    if (y[i].name == "feature_image") {
                        $('.images_section').removeClass("invalid");
                    }
                }
            }
            // select boxes
            for (i = 0; i < z.length; i++) {
                // If a field is empty...
                if (z[i].value == "" && $(z[i]).attr('required')) {
                    $('#'+z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
                    // and set the current valid status to false:
                    valid = false;
                }else {
                    $('#'+z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
                }
            }
            // text areas
            for (i = 0; i < t.length; i++) {
                // If a field is empty...
                if (t[i].value == "" && $(t[i]).attr('required')) {
                    // add an "invalid" class to the field:
                    t[i].classList.add("invalid");
                    // and set the current valid status to false:
                    valid = false;
                }else {
                    t[i].classList.remove("invalid");
                }
            }

            return valid; // return the valid status
        }

        function validateForm2() {
            var categoryId = $('#selectedCategory').val();
            const minimumQuantity = parseFloat($('#minimum_quantity').val());
            const quantityAvailable = parseFloat($('#quantity_available').val());
            var valid = true;

            if (categoryId == 1 || categoryId == 3 || categoryId == 4 || (categoryId == 2 && $('#quantity_available').is('[required]'))) {
                if (quantityAvailable <= 0 || (quantityAvailable < minimumQuantity)) {
                    $('#quantity_available').addClass("invalid");
                    $('.quanity_must_error').removeClass("d-none");
                    valid = false;
                } else {
                    $('.quanity_must_error').addClass("d-none");
                }
            }


            if (categoryId == 1 || categoryId == 4) {
                $('.discount-row').each(function(index) {
                    const discountAmount = parseFloat($(`#discount_amont_${index}`).val());
                    const discountApplied = parseFloat($(`#discount_applied_${index}`).val());

                    if (discountAmount <= minimumQuantity && discountApplied != 0) {
                        $(`#discount_amont_${index}`).addClass("invalid");
                        $(`.dis_quantity_min_error_${index}`).removeClass("d-none");
                        valid = false;
                    } else {
                        $(`.dis_quantity_min_error_${index}`).addClass("d-none");
                    }

                    if (discountAmount > quantityAvailable) {
                        $(`#discount_amont_${index}`).addClass("invalid");
                        $(`.dis_quantity_max_error_${index}`).removeClass("d-none");
                        valid = false;
                    } else {
                        $(`.dis_quantity_max_error_${index}`).addClass("d-none");
                    }

                    if (discountApplied < 0 || (discountApplied == 0 && discountAmount > 0)) {
                        $(`#discount_applied_${index}`).addClass("invalid");
                        $(`.dis_percentage_error_${index}`).removeClass("d-none");
                        valid = false;
                    } else {
                        $(`.dis_percentage_error_${index}`).addClass("d-none");
                    }
                });
            }
            return valid;
        }
    </script>
@endsection