@extends('elements.base')

@section('title')
    <h1 class="text-xl font-semibold my-2">Products</h1>
@endsection

@section('content')
    <div class="flex">
        <div class="w-1/5 bg-gray-100 p-4 -ml-12 rounded-lg shadow-lg">
            <ul class="space-y-4">
                @foreach ($categories as $category)
                    <li class="border-b border-gray-300 pb-2">
                        <h2 class="text-lg font-bold cursor-pointer category-header hover:text-blue-500">{{ $category->category_name }}</h2>
                        <ul class="pl-4 space-y-2 hidden category-products">
                            @foreach (json_decode($category->product) as $product)
                                <li>
                                    <a href="#" class="product-link text-gray-700 hover:text-blue-500" data-id="{{ $product->id }}">{{ $product->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-4/5 bg-white p-6 ml-12 rounded-lg shadow-lg" id="product-details">
            <p class="text-gray-700">請選擇一個產品以查看詳細資料。</p>
        </div>
    </div>
@endsection

@push('scripts')
    document.addEventListener('DOMContentLoaded', function () {
        const categoryHeaders = document.querySelectorAll('.category-header');
        const productLinks = document.querySelectorAll('.product-link');
        const productDetails = document.getElementById('product-details');

        categoryHeaders.forEach(header => {
            header.addEventListener('click', function () {
                const productsList = this.nextElementSibling;
                const allProductsLists = document.querySelectorAll('.category-products');

                allProductsLists.forEach(list => {
                    if (list !== productsList) {
                        list.classList.add('hidden');
                    }
                });

                productsList.classList.toggle('hidden');
            });
        });

        productLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const productId = this.getAttribute('data-id');

                axios.get(`/products/${productId}`)
                    .then(response => {
                        const product = response.data;
                        const elements = JSON.parse(product.elements).join(', ');

                        productDetails.innerHTML = `
                            <h2 class="text-2xl font-bold mb-4">${product.name}</h2>
                            <div class="w-auto h-64 bg-gray-200 mb-4 flex items-center justify-center">
                                <img alt="${product.name}" class="h-full w-auto">
                            </div>
                            <p class="text-gray-700 mb-2">描述: ${product.description}</p>
                            <p class="text-gray-700 mb-2">熱量: ${product.calories}</p>
                            <p class="text-gray-700 mb-2">成分: ${elements}</p>
                        `;
                    })
                    .catch(error => {
                        console.error('Error fetching product details:', error);
                        productDetails.innerHTML = '<p class="text-red-500">無法獲取產品詳細資料。</p>';
                    });
            });
        });
    });
@endpush