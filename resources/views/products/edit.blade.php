<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('dashboard.dash')
        </h2>
    </x-slot>
    @include('products.header')
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary me-md-2"
               href="{{ route('products.index') }}" role="button">Back</a>
        </div>
        <div class="row mb-3">
            <form action="{{ route('product.update', $productI->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">@lang('product.name')</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" required
                           value="{{ $productI->name }}">
                    <div id="name" class="form-text">Please enter the product name.</div>
                </div>
                <div class="mb-3">
                    <label for="ean" class="form-label">@lang('product.ena')</label>
                    <input type="text" class="form-control" name="ean" id="ean" aria-describedby="eanl"
                           value="{{ $productI->ean }}" required>
                    <div id="eanl" class="form-text">Please enter the product parcode.</div>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">@lang('product.weight')</label>
                    <input type="number" min="0" step="0.01" max="10000" oninput="validty.valid||(value='');"
                           class="form-control" name="weight" id="weight" aria-describedby="weightl"
                           value="{{ $productI->weight }}" required>
                    <div id="weightl" class="form-text">Please enter the product weight.</div>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">@lang('product.color')</label>
                    <input type="text" class="form-control" name="color" id="color" aria-describedby="colorl"
                           value="{{ $productI->color }}" required>
                    <div id="colorl" class="form-text">Please enter the product color.</div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">@lang('product.price')</label>
                    <input type="number" min="0" step="0.01" max="10000" oninput="validty.valid||(value='');"
                           class="form-control" name="price" id="price" aria-describedby="price1"
                           value="{{ $productI->price }}" required>
                    <div id="price1" class="form-text">Please enter the product price.</div>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">@lang('product.quantity')</label>
                    <input type="number" class="form-control" name="quantity" min="0" max="1000" id="quantity"
                           aria-describedby="quantity1" value="{{ $productI->quantity }}" required>
                    <div id="quantity1" class="form-text">Please enter the product number.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="status">@lang('product.image')</label>
                    <input type="file" class="form-control" name="image" id="image" aria-describedby="imagel">
                    <input type="hidden" name="old_image" value="{{ asset($productI->image) }}">
                    <div id="imagel" class="form-text">Please choose the product image.</div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="active" class="form-check-input" id="status">
                    <label class="form-check-label" for="status">Status</label>
                </div>
                <button type="submit" class="btn btn-primary">@lang('product.update')</button>
            </form>
        </div>
    </div>

    @include('products.footer')

</x-app-layout>

