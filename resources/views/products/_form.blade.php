@php
    $isEditing = isset($product) && ! empty($product->id);
    $formAction = $formAction ?? ($isEditing ? route('products.update', $product->id) : route('products.store'));
    $httpMethod = $httpMethod ?? ($isEditing ? 'PUT' : 'POST');
    $buttonText = $buttonText ?? ($isEditing ? 'Update Product' : 'Save Product');
    $cancelRoute = $cancelRoute ?? route('products.index');
@endphp

<form action="{{ $formAction }}" method="POST" novalidate>
    @csrf
    @if ($httpMethod !== 'POST')
        @method($httpMethod)
    @endif

    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select
            name="category_id"
            id="category_id"
            class="form-select @error('category_id') is-invalid @enderror"
            @disabled($categories->isEmpty())
        >
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $product->name ?? '') }}"
        >
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <label for="price" class="form-label">Price</label>
            <input
                type="number"
                name="price"
                id="price"
                step="0.01"
                min="0"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price ?? '') }}"
            >
            @error('price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 col-md-6">
            <label for="stock" class="form-label">Stock</label>
            <input
                type="number"
                name="stock"
                id="stock"
                step="1"
                min="0"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock ?? '') }}"
            >
            @error('stock')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" @disabled($categories->isEmpty())>{{ $buttonText }}</button>
    </div>
</form>
