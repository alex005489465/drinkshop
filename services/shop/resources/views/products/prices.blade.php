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

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        table, th, td {
            border: 1px solid #e5e7eb;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
            font-weight: bold;
        }

        .input-field {
            width: 100px;
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
        }

        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
            價格管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>在這裡，您可以查看、編輯所有價格的資訊。</p>
                </div>
                <div class="table-container">
                    <h2 id="price-title" class="font-semibold text-xl text-gray-800 leading-tight p-6">價格列表</h2>
                    <form action="{{ route('products.prices.update') }}" method="POST">
                        @csrf
                        <table>
                            <thead>
                                <tr>
                                    <th>產品 ID</th>
                                    <th>小杯價格</th>
                                    <th>中杯價格</th>
                                    <th>大杯價格</th>
                                    <th>XL 杯價格</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prices as $price)
                                    <tr>
                                        <td>{{ $price->product_id }}</td>
                                        <td>
                                            <input type="number" name="prices[{{ $price->id }}][price_small]" value="{{ $price->price_small }}" class="input-field" min="0" step="1">
                                        </td>
                                        <td>
                                            <input type="number" name="prices[{{ $price->id }}][price_medium]" value="{{ $price->price_medium }}" class="input-field" min="0" step="1">
                                        </td>
                                        <td>
                                            <input type="number" name="prices[{{ $price->id }}][price_large]" value="{{ $price->price_large }}" class="input-field" min="0" step="1">
                                        </td>
                                        <td>
                                            <input type="number" name="prices[{{ $price->id }}][price_xl]" value="{{ $price->price_xl }}" class="input-field" min="0" step="1">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn submit-btn">更新價格</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 在頁面載入時捲動到 id 為 'price-title' 的元素
        window.onload = function() {
            var priceTitle = document.getElementById('price-title');
            if (priceTitle) {
                priceTitle.scrollIntoView();
            }
        };
    </script>
</x-shop-layout>
