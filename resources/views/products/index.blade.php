@php
    $search = 'https';
@endphp

@include('products.header')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('dashboard.dash')
        </h2>
    </x-slot>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-lg"
           href="{{ route('product.create') }}" role="button">@lang('product.add')</a>
    </div>
    <div class="container-fluid">
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
                        <th scope="col">@lang('product.info')</th>
                        <th scope="col">@lang('product.action')</th>
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
                            @if(preg_match("/{$search}/i", $product->image))
                                <td><img src="{{asset($product->image) }}" alt="" style="height: 50px; width: 50px;">
                                </td>
                            @else
                                <td><img src="{{asset('/storage/'.$product->image) }}" alt=""
                                         style="height: 50px; width: 50px;"></td>
                            @endif
                            <td><a href="{{ route('product.show', $product->id) }}"><i
                                        class="fa fa-info-circle"></i></a>
                            </td>
                            <td>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary"
                                       type="button">@lang('product.update')</a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                                type="submit">@lang('product.delete')</button>
                                    </form>
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
</x-app-layout>

