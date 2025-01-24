<div class="flex items-center justify-between px-4 py-0">
    {{-- Left: Logo/Image --}}
    <div class="flex-none">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain object-center">
    </div>

    {{-- Middle: Flexible space --}}
    <div class="flex-1 mx-4">
        @include('elements.links')
    </div>

    {{-- Right: Button --}}
    <div class="flex-none">
        @include('elements.authmenu')
    </div>
</div>