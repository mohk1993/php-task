@include('products.header')
<div class="container-fluid">
    <div class="row mt-4 mx-auto position-relative">
        <a class="btn btn-primary align-right position-absolute top-100 start-50 translate-middle mt-1"
           href="{{ route('product.add.view') }}" type="button">Add product</a>
    </div>
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
                    <th scope="col">Info</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->ean}}</td>
                        <td>{{$product->weight}}</td>
                        <td>{{$product->color}}</td>
                        @if(0 == $product->active)
                            <td><span class="badge text-bg-success">Active</span></td>
                        @else
                            <td><span class="badge text-bg-danger">InActive</span></td>
                        @endif
                        <td><img src="{{$product->image}}" alt="" style="height: 50px; width: 50px;"></td>
                        <td><a href="{{ route('info.product', $product->id) }}"><i class="fa fa-info-circle"></i></a>
                        </td>
                        <td>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="{{ route('product.update.view', $product->id) }}" class="btn btn-primary"
                                   type="button">Update</a>
                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger"
                                   type="button">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@include('products.footer')
