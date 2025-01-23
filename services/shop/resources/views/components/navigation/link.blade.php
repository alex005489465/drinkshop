<style>
/* 確保下拉選單最初是隱藏的 */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    list-style: none;
    padding: 0;
    margin: 0;
    min-width: 150px; /* 根據需要調整寬度 */
}

.dropdown {
    position: relative;
    display: inline-block;
}

.nav-link {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: black;
    cursor: pointer;
}

.nav-link.active {  
    color: black;
}

.flex-container {
    display: flex;
    align-items: center;
}
</style>

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex flex-container">
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
        {{ __('Home') }}
    </a>
    <div class="dropdown">
        <span id="products" class="nav-link {{ request()->routeIs('products.sheets.list') ? 'active' : '' }}">
            {{ __('Products') }}
        </span>
        <ul class="dropdown-menu" id="dropdownMenu">
            <li>
                <a href="{{ route('products.sheets.list') }}" class="nav-link {{ request()->routeIs('products.sheets.list') ? 'active' : '' }}">
                    {{ __('Lists') }}
                </a>
            </li>
            <li>
                <a href="{{ route('products.prices.index') }}" class="nav-link {{ request()->routeIs('products.prices.index') ? 'active' : '' }}">
                    {{ __('Prices') }}
                </a>
            </li>
            <li>
                <a href="{{ route('products.ingredients.index') }}" class="nav-link {{ request()->routeIs('products.ingredients.index') ? 'active' : '' }}">
                    {{ __('Ingredients') }}
                </a>
            </li>
        </ul>
    </div>
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        {{ __('Dashboard') }}
    </a>
</div>

<script>
document.getElementById('products').addEventListener('mouseover', function() {
    document.getElementById('dropdownMenu').style.display = 'block';
});

document.getElementById('products').addEventListener('mouseout', function() {
    document.getElementById('dropdownMenu').style.display = 'none';
});

document.getElementById('dropdownMenu').addEventListener('mouseover', function() {
    document.getElementById('dropdownMenu').style.display = 'block';
});

document.getElementById('dropdownMenu').addEventListener('mouseout', function() {
    document.getElementById('dropdownMenu').style.display = 'none';
});
</script>
