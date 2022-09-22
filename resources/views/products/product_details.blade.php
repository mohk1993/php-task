@include('products.header')

<ul class="nav nav-tabs" id="productDetails" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="product-details-tab" data-bs-toggle="tab" data-bs-target="#product-details-tab-pane" type="button" role="tab" aria-controls="product-details-tab-pane" aria-selected="true">Product Details</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="price-history-tab" data-bs-toggle="tab" data-bs-target="#price-history-tab-pane" type="button" role="tab" aria-controls="price-history-tab-pane" aria-selected="false">Price History</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="quantity-history-tab" data-bs-toggle="tab" data-bs-target="#quantity-history-tab-pane" type="button" role="tab" aria-controls="quantity-history-tab-pane" aria-selected="false">Quantity History</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="product-details-tab-pane" role="tabpanel" aria-labelledby="product-details-tab" tabindex="0">
    {!! $chart->container() !!}
    </div>
    <div class="tab-pane fade" id="price-history-tab-pane" role="tabpanel" aria-labelledby="price-history-tab" tabindex="0">
        Hello form tab two
    </div>
    <div class="tab-pane fade" id="quantity-history-tab-pane" role="tabpanel" aria-labelledby="quantity-history-tab" tabindex="0">
    Hello form tab three
    </div>
</div>


@include('products.footer')
{!! $chart->script() !!}
</body>

</html>