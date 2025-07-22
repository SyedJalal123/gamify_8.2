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
    <div id="customArticleSearchDropdown" class="custom-search-dropdown max-w-100 max-h-fit">
        <!-- -->
    </div>
</div>