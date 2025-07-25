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
                
                `<a href="${homePath}articles/${response[i].slug}" class="default-border-box br-7 mb-2">
                    <div class="d-flex flex-column p-3 ">
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

function get_header_search_items(categoryId) {
    search = $(`#get-header-search-items-${categoryId}`).val();

    $('.phone-header-search .append-items').empty();
    $('.phone-header-search-items').addClass('d-none').removeClass('d-flex');
    $('.phone-header-search .append-items').removeClass('d-none').addClass('d-flex');
    $('.phone-header-search .append-items').append(`<div class="text-theme-primary">searching</div>`);
    
    setTimeout(function () {
        if(search == '') {
            $('.phone-header-search-items').removeClass('d-none').addClass('d-flex');
            $('.phone-header-search .append-items').addClass('d-none').removeClass('d-flex');
        }else {
            $.ajax({
                url: '/get-header-search',
                method: 'GET',
                data: { 
                    search: search, 
                    categoryId: categoryId, 
                },
                success: function (response) {
                    var html = '';
                    for(var i = 0; i < response.length; i++) {
                        html += `<a href="${homePath}catalog/${response[i].id}" class="col-md-6 d-flex mb-3">
                            <img src="${publicPath}${response[i].game.image}" width="25px" class="mr-2" alt="">
                            <span class="fs-15">${response[i].game.name}</span>
                        </a>`;
                    }
        
                    if(response.length == 0) {
                        // $('.phone-header-search-items').removeClass('d-none').addClass('d-flex');
                        $('.phone-header-search .append-items').empty();

                        $('.phone-header-search .append-items').append(`<div class="text-theme-primary">No items found</div>`);

                    } else {
                        $('.phone-header-search .append-items').empty();

                        $('.phone-header-search .append-items').removeClass('d-none').addClass('d-flex');
                        $('.phone-header-search-items').removeClass('d-flex').addClass('d-none');
                        $('.phone-header-search .append-items').append(html);
                    }
                }
            });
        }
    }, 1000);
}

function get_header_search_items_desktop(categoryId) {
    search = $(`#get-header-search-items-desktop-${categoryId}`).val();

    $('.desktop-header-search-append').empty();
    $('.desktop-header-search-items').addClass('d-none').removeClass('d-flex');
    $('.desktop-header-search-append').removeClass('d-none').addClass('d-flex');
    $('.desktop-header-search-append').append(`<div class="text-theme-primary">searching</div>`);
    
    setTimeout(function () {
        if(search == '') {
            $('.desktop-header-search-items').removeClass('d-none').addClass('d-flex');
            $('.desktop-header-search-append').addClass('d-none').removeClass('d-flex');
        }else {
            $.ajax({
                url: '/get-header-search',
                method: 'GET',
                data: { 
                    search: search, 
                    categoryId: categoryId, 
                },
                success: function (response) {
                    var html = '';
                    for(var i = 0; i < response.length; i++) {
                        html += `<a href="${homePath}catalog/${response[i].id}" class="d-flex mb-3 p-0">
                            <span class="fs-15">${response[i].game.name}</span>
                        </a>`;
                    }
        
                    if(response.length == 0) {
                        // $('.phone-header-search-items').removeClass('d-none').addClass('d-flex');
                        $('.desktop-header-search-append').empty();

                        $('.desktop-header-search-append').append(`<div class="text-theme-primary">No items found</div>`);

                    } else {
                        $('.desktop-header-search-append').empty();

                        $('.desktop-header-search-append').removeClass('d-none').addClass('d-flex');
                        $('.desktop-header-search-items').removeClass('d-flex').addClass('d-none');
                        $('.desktop-header-search-append').append(html);
                    }
                }
            });
        }
    }, 1000);
}

function empty_header_search_items(categoryId) {
    setTimeout(function () {
        $(`#get-header-search-items-${categoryId}`).val('')
        $('.phone-header-search .append-items').empty();
        $('.phone-header-search-items').removeClass('d-none').addClass('d-flex');
        $('.phone-header-search .append-items').addClass('d-none').removeClass('d-flex');
    }, 1000);
}


// const { event } = require("jquery");

$('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus');
});

// Custom Search Bar Js

//

// Live AJAX Search
$(document).ready(function() {

    let customSearchInput, customDropdown, customOverlay;

    if (window.matchMedia("(max-width: 768px)").matches) {
        customSearchInput = document.getElementById('customSearchInput2');
        customDropdown = document.getElementById('customSearchDropdown2');
        customOverlay = document.getElementById('customSearchOverlay2');
    } else {
        customSearchInput = document.getElementById('customSearchInput');
        customDropdown = document.getElementById('customSearchDropdown');
        customOverlay = document.getElementById('customSearchOverlay');
    }

    customOverlay.addEventListener('click', () => {
        customDropdown.classList.remove('show');
        customOverlay.classList.remove('show');
        customSearchInput.blur();
    });

    const customContainer = document.querySelector('.custom-search-container');
    let timeout = null;

    if (!customSearchInput || !customDropdown || !customOverlay || !customContainer) return;

    // Show dropdown and overlay when input is focused
    customSearchInput.addEventListener('focus', () => {
        customDropdown.classList.add('show');
        customOverlay.classList.add('show');
        customContainer.classList.add('active');

        // Trigger default fetch if input is empty
        if (!customSearchInput.value.trim()) {
            fetchResults('');
        }
    });

    // Hide dropdown and overlay on overlay click
    customOverlay.addEventListener('click', () => {
        customDropdown.classList.remove('show');
        customOverlay.classList.remove('show');
        customSearchInput.blur();
        customContainer.classList.remove('active');
    });

    // Keyup live search
    customSearchInput.addEventListener('keyup', () => {
        clearTimeout(timeout);
        const query = customSearchInput.value.trim();

        // Show loading
        customDropdown.innerHTML = `<div style="padding: 20px; color: #ccc;">Loading...</div>`;

        timeout = setTimeout(() => {
            fetchResults(query);
        }, 200);
    });

    function fetchResults(query = '') {
                fetch(`/live-search?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                            if (!data.length) {
                                customDropdown.innerHTML = '<div style="padding: 20px; color: #ccc;">No results found.</div>';
                                return;
                            }

                            const title = query ? 'SEARCH RESULTS' : 'POPULAR CATEGORIES';
                            console.log(data);
                            customDropdown.innerHTML = `
            <h4>${title}</h4>
            ${data.map(item => `
                <a href="${item.link}" class="custom-search-category" style="text-decoration: none;">
                    <img src="${item.image}" alt="${item.name}" />
                    ${item.name}
                </a>
            `).join('')}
        `;
})
.catch(() => {
customDropdown.innerHTML = '<div style="padding: 20px; color: #ccc;">Something went wrong.</div>';
});
    }

    $('[data-toggle="tooltip"]').tooltip();
});
//

$('input[type="number"]').on('wheel', function (e) {
    $(this).blur();
});

function animateDetachedOverlay(element) {
    const rect = element.getBoundingClientRect();
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

    const overlay = document.createElement('div');
    overlay.classList.add('price-overlay');

    // Set absolute position based on document scroll
    overlay.style.position = 'absolute';
    overlay.style.top = `${rect.top + scrollTop}px`;
    overlay.style.left = `${rect.left + scrollLeft}px`;
    overlay.style.width = `${rect.width}px`;
    overlay.style.height = `${rect.height}px`;
    overlay.style.pointerEvents = 'none';
    overlay.style.transition = 'opacity 0.3s ease';
    overlay.style.zIndex = 99;
    overlay.style.opacity = '1';

    document.body.appendChild(overlay);

    // Animate out and remove
    setTimeout(() => {
        overlay.style.opacity = '0';
        setTimeout(() => overlay.remove(), 300);
    }, 1000);
}

$('select').on('select2:open', function () {
    const searchBox = $('.select2-container--open .select2-search__field');

    // Simple mobile device check
    const isMobile = /iPhone|Android|iPad|iPod|Mobile/i.test(navigator.userAgent);

    if (!isMobile && searchBox.length) {
        if (!searchBox.is(':focus')) {
            searchBox[0].focus(); // Access the raw DOM element
        }
    }
});

function click_disable(att) {
    $(att).attr('disabled',true);
}

// Define the shortTimeAgo function
function shortTimeAgo(date) {
    const time = new Date(date);
    const now = new Date();
    const diffInSeconds = Math.floor((now - time) / 1000);
    const diffInMonths = (now.getFullYear() - time.getFullYear()) * 12 + (now.getMonth() - time.getMonth());
    const diffInYears = now.getFullYear() - time.getFullYear();

    if (diffInYears >= 1) {
        return time.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }); // Mar 12, 2023
    }

    if (diffInMonths >= 1) {
        return time.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }); // Mar 12
    }

    const times = [
        { label: "d", seconds: 86400 },
        { label: "h", seconds: 3600 },
        { label: "m", seconds: 60 },
        { label: "s", seconds: 1 },
    ];

    for (let i = 0; i < times.length; i++) {
        const timeUnit = times[i];
        const timeValue = Math.floor(diffInSeconds / timeUnit.seconds);

        if (timeValue >= 1) {
            return `${timeValue}${timeUnit.label} ago`;
        }
    }

    return "now";
}


function scroll_bottom(id) {
    const $chatBody = $(id);
    if ($chatBody.length) {
        $chatBody.scrollTop($chatBody[0].scrollHeight);
    }
}

function HideById(id) {
    $('#' + id).hide();
}

function scrollToClass(className, index = 0, delay = 1200) {
    setTimeout(() => {
        const elements = document.querySelectorAll(`.${className}`);
        if (elements.length > index) {
            elements[index].scrollIntoView({
                behavior: 'smooth',
                block: 'start',
                inline: 'nearest'
            });
        } else {
            console.warn(`No element found with class "${className}" at index ${index}`);
        }
    }, delay);
}

updatePlusMinus();

function btnPlus(id) {
    const input = document.getElementById(id);
    input.value = parseInt(input.value, 10) + 1;

    if (parseInt(input.value, 10) < parseInt(input.min, 10)) {
        input.value = input.min;
    }
}

function btnMinus(id) {
    const input = document.getElementById(id);

    if (parseInt(input.value, 10) > parseInt(input.min, 10)) {
        input.value = parseInt(input.value, 10) - 1;
    }

    if (parseInt(input.value, 10) < parseInt(input.min, 10)) {
        input.value = input.min;
    }
}

function updatePlusMinus() {
    document.querySelectorAll('.btn-minus').forEach(btn => {
        btn.onclick = function () {
            const input = this.nextElementSibling;
            if (input.value > input.min) {
                input.value--;
            }

            if (input.value < input.min) {
                input.value = input.min;
            }
        };
    });

    document.querySelectorAll('.btn-plus').forEach(btn => {
        btn.onclick = function () {
            const input = this.previousElementSibling.previousElementSibling;
            input.value++;

            if (input.value < input.min) {
                input.value = input.min;
            }
        };
    });

    document.querySelectorAll('.delete-row').forEach(btn => {
        btn.onclick = function () {
            this.closest('.discount-row').remove();
        };
    });
}



updatePlusMinus2();

// function updatePlusMinus2() {
//     document.querySelectorAll('.btn-minus-2').forEach(btn => {
//         btn.onclick = function () {
//             const input = this.nextElementSibling.nextElementSibling;

//             if (parseInt(input.value) > parseInt(input.min)) {
//                 input.value--;
//             }

//             if (parseInt(input.value) < parseInt(input.min)) {
//                 input.value = input.min;
//             }

//             if (typeof adjustQty === 'function') {
//                 adjustQty();
//             }
//         };
//     });
//     document.querySelectorAll('.btn-plus-2').forEach(btn => {
//         btn.onclick = function () {
//             const input = this.previousElementSibling.previousElementSibling;
//             input.value++;

//             if (parseInt(input.value) < parseInt(input.min)) {
//                 input.value = input.min;
//             }

//             if (typeof adjustQty === 'function') {
//                 adjustQty();
//             }
//         };
//     });
// }

function updatePlusMinus2() {
    document.querySelectorAll('.btn-minus-2').forEach(btn => {
        btn.onclick = function () {
            var idParts = $(this).attr('id').split('-');
            const input = $(`.quantity-input-${idParts[3]}`);

            let value = parseInt(input.val());
            let min = parseInt(input.attr('min'));

            if (value > min) {
                input.val(value - 1);
            }

            if (parseInt(input.val()) < min) {
                input.val(min);
            }

            if (typeof adjustQty === 'function') {
                adjustQty();
            }
        };
    });

    document.querySelectorAll('.btn-plus-2').forEach(btn => {
        btn.onclick = function () {
            var idParts = $(this).attr('id').split('-');
            const input = $(`.quantity-input-${idParts[3]}`);

            let value = parseInt(input.val());
            let min = parseInt(input.attr('min'));

            input.val(value + 1);

            if (parseInt(input.val()) < min) {
                input.val(min);
            }

            if (typeof adjustQty === 'function') {
                adjustQty();
            }
        };
    });
}


function showLiveImageModal(url, type) {
    const mediaContent = document.getElementById("liveMediaContent");

    // Stop/reset existing video if present
    const existingVideo = document.querySelector(
        "#liveMediaModal video"
    );
    if (existingVideo) {
        existingVideo.pause();
        existingVideo.currentTime = 0;
    }

    // Set new content
    if (type === "image") {
        mediaContent.innerHTML = `<img src="${url}" class="img-fluid" alt="Image">`;
    } else if (type === "video") {
        mediaContent.innerHTML = `
            <video class="img-fluid" controls autoplay>
                <source src="${url}" type="video/mp4">
                Your browser does not support the video tag.
            </video>`;
    }

    // Set download button URL
    document.getElementById("downloadBtn").href = url;

    // Attach one-time event to stop/reset video when modal is closed
    $("#liveMediaModal").one("hidden.bs.modal", function () {
        const video = document.querySelector("#liveMediaModal video");
        if (video) {
            video.pause();
            video.currentTime = 0;
        }
        mediaContent.innerHTML = "";
    });
}

document.querySelectorAll('.dropdown-menu.stay-open').forEach(function (menu) {
    menu.addEventListener('click', function (e) {
        const tag = e.target.tagName.toLowerCase();
        const isFormElement = ['input', 'textarea', 'select', 'label'].includes(tag);
        const isInsideToggle = e.target.closest('[data-toggle="collapse"]');
        const isCollapseTarget = e.target.closest('.collapse');

        if (isFormElement || isInsideToggle || isCollapseTarget) {
            setTimeout(() => {
                $('#dropdownMenu3').click();
            }, 0);
        }
    });
});

// Toast Notifications
document.addEventListener("DOMContentLoaded", function () {

    document.addEventListener("toast.success", event => {   
        toastr.options = {
            "closeButton": true,
        }
        toastr.success(event.detail.message);
        // toastr["success"]("Clear itself?<br /><br /><button type='button' class='btn clear'>Yes</button>")
    });

    document.addEventListener("toast.changed", event => {   
        toastr.options = {
            "closeButton": true,
        }
        toastr.changed(event.detail.message);
    });

    document.addEventListener("toast.info", event => {
        toastr.options = {
            "closeButton": true,
        }
        toastr.info(event.detail.message);
    });

    document.addEventListener("toast.warning", event => {
        toastr.options = {
            "closeButton": true,
        }
        toastr.warning(event.detail.message);
    });

    document.addEventListener("toast.error", event => {
        toastr.options = {
            "closeButton": true,
        }
        toastr.error(event.detail.message);
    });
});

function autoResize(el) {
  el.style.height = 'auto';
  el.style.height = el.scrollHeight + 'px';
}

$(document).ready(function() {
  const textareas = document.querySelectorAll('.auto-resize-textarea');
  textareas.forEach(textarea => {
    autoResize(textarea); // Resize on load
    textarea.addEventListener('input', () => autoResize(textarea)); // Resize on input
  });
});

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        toastr.options = {
            "closeButton": true,
        }
        toastr.success('Copied to clipboard');
    }, function(err) {
        toastr.options = {
            "closeButton": true,
        }
        toastr.error(err);
    });
}

function markNotificationAsRead(notificationId) {
    Livewire.dispatch('mark-as-read', [notificationId]);
}

if (!window.notificationsCountUpdate) {
    window.notificationsCountUpdate = true;

    Livewire.on('notifications-count-update', (e) => {
        $('.count-notifications').text(e.count);

        if(e.count == 0){
            $('#count-header-button').addClass('d-none');
        }else {
            $('#count-header-button').removeClass('d-none');
        }

    });
}

function handleNotificationClick(event, href) {
    // If the click happened inside an element marked to ignore navigation
    if (event.target.closest('[data-ignore-navigation]')) {
        return;
    }

    // Otherwise navigate using Livewire’s router manually
    Livewire.navigate(href);
}

function toggle_input_visibility(id) {
    const input = document.getElementById(id);
    if (!input) return;

    input.type = input.type === 'password' ? 'text' : 'password';
}

function validatePassword(password) {
    const trimmed = password.trim();

    return {
        minLength: trimmed.length >= 8,
        hasUppercase: /[A-Z]/.test(trimmed),
        hasLowercase: /[a-z]/.test(trimmed),
        hasNumber: /[0-9]/.test(trimmed),
        noSpaces: trimmed === password && trimmed.length > 0
    };
}

function updateRule(id, isValid) {
    const el = document.getElementById(id);
    if (!el) return;

    const icon = el.querySelector('i');
    el.classList.remove('text-theme-teal', 'text-theme-cherry');
    el.classList.add(isValid ? 'text-theme-teal' : 'text-theme-cherry');
    icon.className = isValid ? 'bi bi-check fs-15' : 'bi bi-x fs-15';
}