@php
    $prefix = Request::url();
    $route = Route::current()->getName();
@endphp

@include('products.header')
{{-- Tabs Header --}}
<ul class="nav nav-tabs" id="productInfo" role="tablist">
    {{-- Tab-item for product details --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->is('info/'.$productInfo->id) ? 'active' : null }}"
           href="{{ route('info.product', $productInfo->id) }}" type="button" role="tab">Product Details
        </a>
    </li>
    {{-- Tab-item for product price hisory --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->is('price-history/'.$productInfo->id) ? 'active' : null }}"
           href="{{ route('history.price', $productInfo->id) }}" type="button" role="tab">Price History</a>
    </li>
    {{-- Tab-item for product quantity history --}}
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->is('quantity-history/'.$productInfo->id) ? 'active' : null }}"
           href="{{ route('history.quantity', $productInfo->id) }}" type="button" role="tab">Quantity History</a>
    </li>
</ul>
{{-- Tabs content --}}
<div class="tab-content" id="productInfoContent">
    {{-- Tab-pan for product details --}}
    <div class="tab-pane {{ request()->is('info/'.$productInfo->id) ? 'active' : null }}"
         id="{{ route('info.product', $productInfo->id) }}" role="tabpanel" aria-labelledby="home-info-tab"
         tabindex="0">

        <div class="container-fluid">
            <p class="text-center">
            <h1 class="text-center"> Product Details </h1>
            </p>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-dark table-striped align-middle mt-4 mx-auto">
                        <thead>
                        <tr>
                            <th scope="col">name</th>
                            <th scope="col">EAN</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Color</th>
                            <th scope="col">Active</th>
                            <th scope="col">Image/s</th>
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
    <div class="tab-pane {{ request()->is('price-history/'.$productInfo->id) ? 'active' : null }}"
         id="{{ route('history.price', $productInfo->id) }}" role="tabpanel" aria-labelledby="price-tab" tabindex="0">
        @if(request()->is('price-history/'.$productInfo->id))
            {
            <div class="container">
                <p class="text-center">
                <h1 class="text-center"> Price History Chart </h1> </p>
                {!! $priceChart->container() !!}
            </div>
            }
        @endif
    </div>
    {{-- Tab-pan for product quantity Chart --}}
    <div class="tab-pane {{ request()->is('quantity-history/'.$productInfo->id) ? 'active' : null }}"
         id="{{ route('history.quantity', $productInfo->id) }}" role="tabpanel" aria-labelledby="quantity-tab"
         tabindex="0">
        @if(request()->is('quantity-history/'.$productInfo->id))
            {
            <div class="container">
                <p class="text-center">
                <h1 class="text-center"> Quantity History Chart </h1> </p>
                {!! $quantityChart->container() !!}
            </div>
            }
        @endif
    </div>
</div>
@include('products.footer')

@if(request()->is('price-history/'.$productInfo->id))
    {
    {!! $priceChart->script() !!}
    }
@endif
@if(request()->is('quantity-history/'.$productInfo->id))
    {
    {!! $quantityChart->script() !!}
    }
    @endif
    </body>
    </html>
