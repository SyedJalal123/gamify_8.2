setTimeout(function() {
    $('#nationality_select').select2();
}, 1000); // Wait 1 second before initializing
setTimeout(function() {
    $('#country_select').select2();
}, 1000); // Wait 1 second before initializing

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {

    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");

    if (x.length == 3) {
        addLastStepVisibility();
    } else {
        removeLastStepVisibility();
    }
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    setTimeout(() => {
        var x = document.getElementsByClassName("tab");

        // Exit the function if any field in the current tab is invalid:
        if ((n == 1 && !validateForm()) || (currentTab + n >= x.length && !validateForm2())) {
            if ((currentTab + n >= x.length && !validateForm2()) || (n == 1 && !validateForm())) {
                return false;
            }
            return false;
        }

        // if you have reached the end of the form... :
        if (currentTab + n >= x.length) {
            //...the form gets submitted:
            document.getElementById("loadingScreen").style.display = "flex";
            document.getElementById("regForm").submit();
            return false;
        } else {
            // Hide the current tab:
            x[currentTab].style.display = "none";

            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;

            // Otherwise, display the correct tab:
            showTab(currentTab);
        }
    }, 1);
}

function validateForm2() {
    var categoryId = $('#selectedCategory').val();
    const minimumQuantity = parseFloat($('#minimum_quantity').val());
    const quantityAvailable = parseFloat($('#quantity_available').val());
    var valid = true;

    if (categoryId == 1 || categoryId == 3 || categoryId == 4) {
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

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    var checkboxes = Array.from(y).filter(input => input.type === 'checkbox');
    var y = Array.from(y).filter(input => input.type !== 'checkbox');
    z = x[currentTab].getElementsByTagName("select");
    t = x[currentTab].getElementsByTagName("textarea");

    // checkboxes
    for (i = 0; i < checkboxes.length; i++) {
        // If a field is empty...
        if ($(checkboxes[i]).attr('required') && $(checkboxes[i]).attr('type') == 'checkbox' && !$(checkboxes[i]).is(':checked')) {
            if (checkboxes[i].name == 'termsService' || checkboxes[i].name == 'sellerRules') {
                $('.rules_error').removeClass("d-none");
            }
            valid = false;
        } else if ($(checkboxes[i]).attr('required')) {
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
        } else {
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
            $('#' + z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid red');
            // and set the current valid status to false:
            valid = false;
        } else {
            $('#' + z[i].id).next('.select2-container').find('.select2-selection').css('border', '1px solid #aaaaaa');
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
        } else {
            t[i].classList.remove("invalid");
        }
    }

    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
}

function addLastStepVisibility() {

    let steps = document.querySelectorAll('.step'); // Select all step elements

    if (steps.length > 0) {
        steps[steps.length - 1].classList.add('d-none', steps.length === 1);
    }
}

function removeLastStepVisibility() {

    let steps = document.querySelectorAll('.step'); // Select all step elements

    if (steps.length > 0) {
        steps[steps.length - 1].classList.remove('d-none', steps.length === 1);
    }
}

$(document).ready(function() {
    const manualMethodRadio = document.getElementById('manual_method');
    const automaticMethodRadio = document.getElementById('automatic_method');
    const manualSection = document.getElementById('manual_method_show');

    manualMethodRadio.addEventListener('click', () => {
        manualSection.style.display = 'block'; // Show
    });

    automaticMethodRadio.addEventListener('click', () => {
        manualSection.style.display = 'none'; // Hide
    });
});

// Get data and other functions

function selectCategory(categoryId) {
    // Set the selected category ID in the hidden input field
    $('#selectedCategory').val(categoryId);


    let titleInput = $('input[name="title"]');

    // for hiding and showing the category classes
    let selectedCategoryClass;
    let selectedCategoryRequiredClass;
    let tab2 = document.querySelector('.tab_2');
    let tab3 = document.querySelector('.tab_3');

    if (categoryId == 5) {
        tab2.firstElementChild.classList.remove('tab');
        tab3.firstElementChild.classList.remove('tab');

        tab2.classList.add('d-none');
        tab3.classList.add('d-none');
    } else {
        tab2.firstElementChild.classList.add('tab');
        tab3.firstElementChild.classList.add('tab');

        tab2.classList.remove('d-none');
        tab3.classList.remove('d-none');
    }

    switch (categoryId) {
        case 1:
            selectedCategoryClass = 'currency_class';
            selectedCategoryRequiredClass = 'currency_r';
            break;
        case 2:
            selectedCategoryClass = 'accounts_class';
            selectedCategoryRequiredClass = 'accounts_r';
            break;
        case 3:
            selectedCategoryClass = 'topup_class';
            selectedCategoryRequiredClass = 'topup_r';
            break;
        case 4:
            selectedCategoryClass = 'items_class';
            selectedCategoryRequiredClass = 'items_r';
            break;
        default:
            selectedCategoryClass = 'boosting_class';
            selectedCategoryRequiredClass = 'boosting_r';
    }

    // Get all elements that may contain these categories
    const allElements = document.querySelectorAll('.currency_class, .accounts_class, .topup_class, .items_class, .boosting_class');

    // Hide all elements first
    allElements.forEach(element => {
        element.style.display = 'none';
    });

    // Show only the elements with the selected category class
    const selectedElements = document.querySelectorAll(`.${selectedCategoryClass}`);
    selectedElements.forEach(element => {
        element.style.display = 'block';
    });

    // Now handle the required attribute
    const allRequiredElements = document.querySelectorAll('.currency_r, .accounts_r, .topup_r, .items_r');

    // Remove 'required' from all first
    allRequiredElements.forEach(element => {
        element.removeAttribute('required');
    });

    // Add 'required' only to the selected category _r class
    const selectedRequiredElements = document.querySelectorAll(`.${selectedCategoryRequiredClass}`);
    selectedRequiredElements.forEach(element => {
        element.setAttribute('required', 'required');
    });
    //
}
$(document).ready(function() {
    $('.category-item').click(function() {
        let categoryId = $(this).data('category-id');
        $('#selectedCategory').val(categoryId);

        $('#games-dropdown').html('<option value="" disabled selected>Select a Game</option>');
        // $('#games-container').hide();
        $('.skeleton-overlay-start').removeClass('d-none');
        $('#category-attributes-list').empty();

        // Populate games
        $.get('/get-games', { category_id: categoryId }, function(data) {
            if (data.categoryGames.length > 0) {
                data.categoryGames.forEach(categoryGame => {
                    $('#games-dropdown').append(`<option value="${categoryGame.id}">${categoryGame.game.name}</option>`);
                });
                // $('#games-container').show();
                $('.skeleton-overlay-start').addClass('d-none');
            }
            // Apply Select2 to all select elements
            $('select').select2({
                dropdownPosition: 'below',
            });
            //
        });

        // Game change listener
        $('#games-dropdown').off('change').on('change', function() {
            let categoryGameId = $(this).val();
            $('#category_game_id').val(categoryGameId);
            $.get('/get-attributes', { categoryGameId: categoryGameId }, function(data) {
                $('#game-attributes-list').empty();
                $('#category-attributes-list').empty();

                renderAttributes(data.gameAttributes, 'game-attributes-list');

                // adding feature values
                $('.feature_details').text('');

                // Set common values
                $('.feature_image').attr("src", publicPath + data.categoryGame.feature_image);
                $('.feature_currency').text(data.categoryGame.title);

                // Set currency type based on categoryId
                $('.feature_currency__default_amount').toggleClass('hidden', categoryId !== 1);
                $('.feature_currency_type').text((categoryId == 1) ? data.categoryGame.currency_type : 'unit');
                //
            });

        });

        $('.attributes-container').show();
    });
});

function renderAttributes(attributes, targetId) {

    let tab3 = document.querySelector('.tab_3');
    let firstChildTab = tab3.firstElementChild;

    if (firstChildTab && (targetId == 'game-attributes-list')) {
        firstChildTab.classList.toggle('tab', attributes.length > 0);
        tab3.style.display = attributes.length > 0 ? 'block' : 'none';
    }

    attributes.forEach(attr => {
        let inputField = '';

        if (attr.title == 1) {
            $('input[name="title"]').val(attr.name);
        }

        if (attr.type === 'text') {
            inputField = `<input type="text" name="attribute_${attr.id}" placeholder="${attr.name}" class="form-control" />`;
        } else if (attr.type === 'select') {

            let selectClass = attr.topup === 1 ? 'topup_select_boxes' : 'attribute_select_boxes';
            let onchangeFunction = attr.topup === 1 ? 'updateTopupBox(this)' : 'updateTextBox()';

            let options = `<option value="" disabled selected>Select ` + attr.name + `</option>` + // Add the default "Select" option
                attr.options.map(option => `<option value="${option}">${option}${attr.topup === 1 ? ' ' + attr.name : ''}</option>`).join('');
            inputField = `<select name="attribute_${attr.id}" id="attribute_${attr.id}" class="form-control ${selectClass} select2" onchange="${onchangeFunction}" required>${options}</select>`;
        }

        $(`#${targetId}`).append(`
            <div class="attribute-item">
                <label class="mt-3">${attr.name}:</label>
                ${inputField}
            </div>
        `);
    });

    // Selet2 Initialization
    $('select').select2({
        dropdownPosition: 'below',
    });
    $('select').on('select2:open', function() {
        const searchBox = $('.select2-container--open .select2-search__field');

        // Simple mobile device check
        const isMobile = /iPhone|Android|iPad|iPod|Mobile/i.test(navigator.userAgent);

        if (!isMobile && searchBox.length) {
            if (!searchBox.is(':focus')) {
                searchBox[0].focus(); // Access the raw DOM element
            }
        }
    });
    ////
}
// Function to append the select box value to the text box
function updateTextBox() {
    var category = $('#selectedCategory').val();
    let selectedValues = [];


    // Loop through all select boxes with class .attribute_select_boxes
    $('.attribute_select_boxes').each(function() {
        const selectedValue = $(this).val();

        // If a value is selected, append it to the selectedValues array
        if (selectedValue) {
            selectedValues.push(selectedValue);
        }
    });

    $('.feature_details').text(selectedValues.join(' - '));
}

function updateTopupBox(selectElement) {
    let selectedText = $(selectElement).find('option:selected').text();
    $('.feature_topup').text(selectedText);
}

$(document).ready(function() {
    // Apply Select2 to all select elements
    $('select').select2({
        dropdownPosition: 'below',
    });
});


// Images Script
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
                <button class="btn btn-minus mr-1" type="button">-</button>
                <input type="number" class="form-control text-center input-group-text-input" id="discount_amont_${lastNumber}" name="discount_amont[]" value="0" min="0">
                <span class="input-group-text">${currency_type}</span>
                <button class="btn btn-plus ml-1" type="button">+</button>
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <button class="btn btn-minus mr-1" type="button">-</button>
                <input type="number" class="form-control text-center input-group-text-input" id="discount_applied_${lastNumber}" name="discount_applied[]" value="0" min="0" max="100">
                <span class="input-group-text">%</span>
                <button class="btn btn-plus ml-1" type="button">+</button>
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
    window.accountCounter = 1;
}
$('#addAccountBtn').click(function() {
    accountCounter++;
    const newAccount = `
        <div class="account-field mt-4 position-relative">
        <label class="form-label">Account ${accountCounter}</label>
        <button type="button" class="btn-delete btn-remove-account" style="position:absolute;top:0;right:0;">
            <i class="bi bi-trash"></i>
        </button>
        <textarea class="form-control" name="account_info[]" rows="2" placeholder="Type here..."></textarea>
        </div>
    `;

    $('#additionalAccounts').append(newAccount);
});

$(document).on('click', '.btn-remove-account', function() {
    $(this).closest('.account-field').remove();
});


// Toggle button css Boosting
// const collapseEl = document.getElementById('serviceOptions');
// const headerEl = collapseEl.previousElementSibling;
// const icon = headerEl.querySelector('.arrow-icon');

// $('#serviceOptions').on('show.bs.collapse', function () {
//     icon.classList.remove('bi-chevron-down');
//     icon.classList.add('bi-chevron-up');
// });

// $('#serviceOptions').on('hide.bs.collapse', function () {
//     icon.classList.remove('bi-chevron-up');
//     icon.classList.add('bi-chevron-down');
// });


function toggleService(element) {
    const serviceId = element.dataset.serviceId;
    const totalAvailable = element.dataset.totalAvaliable;
    const key = element.dataset.key;
    const isChecked = element.checked;

    $.get("/toggle-service", {
        service_id: serviceId,
        total_available: totalAvailable,
        subscribed: isChecked
    }, function(data) {
        if (data.status === 'success') {
            const subscriptionData = document.querySelector(`.subscription-data-${key}`);
            subscriptionData.textContent = data.subscribedText;
            subscriptionData.classList.add(data.class);
            if (data.class == "text-success") {
                subscriptionData.classList.remove("text-muted");
            } else {
                subscriptionData.classList.remove("text-success");
            }
        } else {
            alert('Failed to update subscription.');
        }
    }).fail(function() {
        alert('Something went wrong!');
    });
}