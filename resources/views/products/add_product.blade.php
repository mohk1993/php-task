@include('products.header')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('dashboard.dash')
        </h2>
    </x-slot>
    <div class="container-fluid">
        <div class="row mb-3">
            <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">@lang('product.name')</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" required>
                    <div id="name" class="form-text">Please enter the product name.</div>
                </div>
                <div class="mb-3">
                    <label for="ean" class="form-label">@lang('product.ena')</label>
                    <input type="text" class="form-control" name="ean" id="ean" aria-describedby="eanl" required>
                    <div id="eanl" class="form-text">Please enter the product parcode.</div>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">@lang('product.weight')</label>
                    <input type="double" class="form-control" name="weight" id="weight" aria-describedby="weightl" required>
                    <div id="weightl" class="form-text">Please enter the product weight.</div>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">@lang('product.color')</label>
                    <input type="text" class="form-control" name="color" id="color" aria-describedby="colorl" required>
                    <div id="colorl" class="form-text">Please enter the product color.</div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">@lang('product.price')</label>
                    <input type="number" min="0" step="0.1" max="10000" oninput="validty.valid||(value='');" class="form-control" name="price" id="price" aria-describedby="price1" required>
                    <div id="price1" class="form-text">Please enter the product price.</div>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">@lang('product.quantity')</label>
                    <input type="number" class="form-control" name="quantity" min="0" max="1000" id="quantity" aria-describedby="quantity1" required>
                    <div id="quantity1" class="form-text">Please enter the product number.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="status">@lang('product.image')</label>
                    <input type="file" class="form-control" name="image" id="image" aria-describedby="imagel" required>
                    <div id="imagel" class="form-text">Please choose the product image.</div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="active" class="form-check-input" id="status">
                    <label class="form-check-label" for="status">Status</label>
                </div>
                <button type="submit" class="btn btn-primary">@lang('product.add')</button>
            </form>
        </div>
    </div>

    @include('products.footer')

</x-app-layout>
