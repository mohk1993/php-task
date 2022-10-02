@php
    $prefix = Request::url();
    $route = Route::current()->getName();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('dashboard.dash')
        </h2>
    </x-slot>

    @include('products.header')
    {{-- Tabs Header --}}
    <ul class="nav nav-tabs" id="productInfo" role="tablist">
        {{-- Tab-item for product details --}}
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->is('products/'.$productInfo->id) ? 'active' : null }}"
               href="{{ route('product.show', $productInfo->id) }}" type="button" role="tab">@lang('product.details')
            </a>
        </li>
        
        {{-- Tab-item for product price hisory --}}
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->is('products/'.$productInfo->id.'/price') ? 'active' : null }}"
               href="{{ route('price.show', $productInfo->id) }}" type="button" role="tab">@lang('product.price_history')</a>
        </li>
        {{-- Tab-item for product quantity history --}}
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->is('products/'.$productInfo->id.'/quantity') ? 'active' : null }}"
               href="{{ route('quantity.show', $productInfo->id) }}" type="button" role="tab">@lang('product.quantity_history')</a>
        </li>
    </ul>
    {{-- Tabs content --}}
    <div class="tab-content" id="productInfoContent">
        {{-- Tab-pan for product details --}}
        <div class="tab-pane {{ request()->is('products/'.$productInfo->id) ? 'active' : null }}"
             id="{{ route('product.show', $productInfo->id) }}" role="tabpanel" aria-labelledby="home-info-tab"
             tabindex="0">

            <div class="container-fluid">
                <p class="text-center">
                <h1 class="text-center"> @lang('product.details') </h1>
                </p>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped align-middle mt-4 mx-auto">
                            <thead>
                            <tr>
                                <th scope="col">@lang('product.name')</th>
                                <th scope="col">@lang('product.ena')</th>
                                <th scope="col">@lang('product.weight')</th>
                                <th scope="col">@lang('product.color')</th>
                                <th scope="col">@lang('product.state')</th>
                                <th scope="col">@lang('product.image')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$productInfo->name}}</td>
                                <td>{{$productInfo->ean}}</td>
                                <td>{{$productInfo->weight}}</td>
                                <td>{{$productInfo->color}}</td>
                                @if(0 == $productInfo->active)
                                    <td><span class="badge text-bg-success">Active</span></td>
                                @else
                                    <td><span class="badge text-bg-danger">InActive</span></td>
                                @endif
                                <td><img src="{{$productInfo->image}}" alt="" style="height: 50px; width: 50px;"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tab-pan for product Price Chart --}}
        <div class="tab-pane {{ request()->is('products/'.$productInfo->id.'/price') ? 'active' : null }}"
             id="{{ route('price.show', $productInfo->id) }}" role="tabpanel" aria-labelledby="price-tab" tabindex="0">
            @if(request()->is('products/'.$productInfo->id.'/price'))
                {
                <div class="container">
                    <p class="text-center">
                    <h1 class="text-center"> @lang('product.price_history') </h1> </p>
                    {!! $priceChart->container() !!}
                </div>
                }
            @endif
        </div>
        {{-- Tab-pan for product quantity Chart --}}
        <div class="tab-pane {{ request()->is('products/'.$productInfo->id.'/quantity') ? 'active' : null }}"
             id="{{ route('quantity.show', $productInfo->id) }}" role="tabpanel" aria-labelledby="quantity-tab"
             tabindex="0">
            @if(request()->is('products/'.$productInfo->id.'/quantity'))
                {
                <div class="container">
                    <p class="text-center">
                    <h1 class="text-center"> @lang('product.quantity_history') </h1> </p>
                    {!! $quantityChart->container() !!}
                </div>
                }
            @endif
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary me-md-2"
               href="{{ route('products.index') }}" role="button">Back</a>
    </div>
    @include('products.footer')

    @if(request()->is('products/'.$productInfo->id.'/price'))
        {
        {!! $priceChart->script() !!}
        }
    @endif
    @if(request()->is('products/'.$productInfo->id.'/quantity'))
        {
        {!! $quantityChart->script() !!}
        }
        @endif
        </body>
        </html>
</x-app-layout>

