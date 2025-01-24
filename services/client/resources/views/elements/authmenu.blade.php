<div class="relative inline-block text-left" x-data="{ open: false }">
    <button type="button" 
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 hover:text-gray-200"
            id="auth-menu-button"
            onclick="$('#auth-menu').toggle()">
        <span>
            @auth
                {{ Auth::user()->name }}
            @else
                訪客
            @endauth
        </span>
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div class="absolute right-0 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 hidden"
         id="auth-menu"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="auth-menu-button">
        <div class="py-1" role="none">
            @auth
                <a href="{{ route('profile.edit') }}" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                   role="menuitem">個人資料</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                            role="menuitem">登出</button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                   role="menuitem">登入</a>
                <a href="{{ route('register') }}" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                   role="menuitem">註冊</a>
            @endauth
        </div>
    </div>
</div>

<script type="module">
$(document).ready(function() {
    // Close dropdown when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('#auth-menu-button, #auth-menu').length) {
            $('#auth-menu').hide();
        }
    });
});
</script>