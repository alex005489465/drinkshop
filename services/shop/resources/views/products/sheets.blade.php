<x-shop-layout>
    <style>
        .form-container {
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            max-width: 800px;
            margin: auto;
        }

        .product-list {
            list-style: none;
            padding: 0;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .product-label {
            flex: 0 0 120px;
            font-weight: bold;
            display: inline-block;
            white-space: nowrap;
        }

        .input-field, .select-field {
            flex: 1;
            padding: 8px;
            margin-right: 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
        }

        .input-field:focus, .select-field:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-btn {
            background-color: #10b981;
            color: white;
            margin-right: 8px;
        }

        .add-btn:hover {
            background-color: #059669;
        }

        .submit-btn {
            background-color: #3b82f6;
            color: white;
        }

        .submit-btn:hover {
            background-color: #2563eb;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            這裡是編輯產品的頁面！
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>在這裡，您可以查看、編輯、所有產品的資訊。</p>
                    <p>您可以點擊下方的按鈕，新增新的產品。</p>
                    <p>您也可以編輯每個產品，最後點擊按鈕進行修改。</p>
                    <p>請享受您的編輯體驗！</p>
                </div>
                <div>
                    <h2 id="product-title" class="font-semibold text-xl text-gray-800 leading-tight p-6">產品列表</h2>
                    <form action="{{ route('products.sheets.saved') }}" method="POST">
                        @csrf
                        <div class="form-container p-6 text-gray-900">
                            <ul id="product-list" class="product-list">
                                @foreach ($sheets as $sheet)
                                    <li class="product-item">
                                        <input type="hidden" name="sheets[{{ $loop->index }}][product_id]" value="{{ $sheet->product_id }}">
                                        <label class="product-label">產品 ID: {{ $sheet->product_id }}</label>
                                        <input type="text" name="sheets[{{ $loop->index }}][product_name]" value="{{ $sheet->product_name }}" class="input-field">
                                        <select name="sheets[{{ $loop->index }}][status]" class="select-field">
                                            <option value="available" {{ $sheet->status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="unavailable" {{ $sheet->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                        </select>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn add-btn" onclick="addNewEntry()">新增</button>
                            <button type="submit" class="btn submit-btn">修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addNewEntry() {
            var productList = document.getElementById('product-list');
            var newIndex = productList.children.length;

            var newEntry = document.createElement('li');
            newEntry.className = "product-item";
            newEntry.innerHTML = `
            <input type="hidden" name="sheets[${newIndex}][product_id]" value="create">
            <label>產品 ID: 新條目</label>
            <input type="text" name="sheets[${newIndex}][product_name]" value="" class="input-field">
            <select name="sheets[${newIndex}][status]" class="select-field">
                <option value="available" selected>Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
            `;
            productList.appendChild(newEntry);
        }

        // 在頁面載入時捲動到 id 為 'product-list' 的元素
        window.onload = function() {
            var productList = document.getElementById('product-title');
            if (productList) {
                productList.scrollIntoView();
            }
        };
    </script>
</x-shop-layout>