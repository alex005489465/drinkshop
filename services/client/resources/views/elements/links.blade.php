<div class="flex space-x-4">
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 text-gray-300 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">
        <i class="fas fa-home"></i>
        首頁
    </a>
    <a href="{{ route('products.list') }}" class="flex items-center gap-2 px-4 py-2 text-gray-300 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">
        <i class="fas fa-box"></i>
        產品
    </a>
    <a href="{{ route('products.select') }}" class="flex items
    -center gap-2 px-4 py-2 text-gray-300 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">
        <i class="fas fa-box-open"></i>
        選擇產品
    </a>
    <a href="{{ route('products.vue') }}" class="flex items
    -center gap-2 px-4 py-2 text-gray-300 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors">
        <i class="fas fa-box-open"></i>
        Vue 產品
    </a>
</div>
