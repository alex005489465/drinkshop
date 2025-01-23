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
            配料管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>在這裡，您可以查看、編輯所有配料的資訊。</p>
                </div>
                <div class="table-container">
                    <h2 id="ingredient-title" class="font-semibold text-xl text-gray-800 leading-tight p-6">配料列表</h2>
                    <button type="button" class="btn submit-btn" onclick="document.getElementById('add-ingredient-modal').style.display='block'">新增配料</button>
                    <form id="ingredient-form" action="{{ route('products.ingredients.update') }}" method="POST">
                        @csrf
                        <table>
                            <thead>
                                <tr>
                                    <th>配料 ID</th>
                                    <th>配料名稱</th>
                                    <th>價格</th>
                                    <th>狀態</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingredients as $index => $ingredient)
                                    <tr class="product-item">
                                        <input type="hidden" name="ingredients[{{ $loop->index }}][id]" value="{{ $ingredient->id }}">
                                        <td>{{ $ingredient->id }}</td>
                                        <td>
                                            <input type="text" name="ingredients[{{ $loop->index }}][ingredient_name]" value="{{ $ingredient->ingredient_name }}" class="input-field">
                                        </td>
                                        <td>
                                            <input type="number" name="ingredients[{{ $loop->index }}][price]" value="{{ $ingredient->price }}" class="input-field" min="0" step="1">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="ingredients[{{ $loop->index }}][is_active]" {{ $ingredient->is_active ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn submit-btn">更新配料</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div id="add-ingredient-modal" style="display:none;">
        <div class="form-container">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">新增配料</h2>
            <form id="add-ingredient-form" action="{{ route('products.ingredients.create') }}" method="POST">
                @csrf
                <div>
                    <label for="ingredient_name">配料名稱：</label>
                    <input type="text" name="ingredient_name" id="ingredient_name" class="input-field" required>
                </div>
                <div>
                    <label for="price">價格：</label>
                    <input type="number" name="price" id="price" class="input-field" min="0" step="1" required>
                </div>
                <div>
                    <label for="is_active">是否啟用：</label>
                    <input type="checkbox" name="is_active" id="is_active">
                </div>
                <button type="submit" class="btn submit-btn">新增</button>
                <button type="button" class="btn" onclick="document.getElementById('add-ingredient-modal').style.display='none'">取消</button>
            </form>
        </div>
    </div>

    <script>
        
    </script>
</x-shop-layout>
