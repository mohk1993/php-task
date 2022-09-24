@include('products.header')
<div class="container-fluid">
    <div class="row mb-3">
        <form action="{{ route('product.update', $productI->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="name" required
                       value="{{ $productI->name }}">
                <div id="name" class="form-text">Please enter the product name.</div>
            </div>
            <div class="mb-3">
                <label for="ean" class="form-label">EAN</label>
                <input type="text" class="form-control" name="ean" id="ean" aria-describedby="eanl"
                       value="{{ $productI->ean }}" required>
                <div id="eanl" class="form-text">Please enter the product parcode.</div>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Product Weight</label>
                <input type="double" class="form-control" name="weight" id="weight" aria-describedby="weightl"
                       value="{{ $productI->weight }}" required>
                <div id="weightl" class="form-text">Please enter the product weight.</div>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Produc Wolor</label>
                <input type="text" class="form-control" name="color" id="color" aria-describedby="colorl"
                       value="{{ $productI->color }}" required>
                <div id="colorl" class="form-text">Please enter the product color.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Product Image</label>
                <input type="file" class="form-control" name="image" id="image" aria-describedby="imagel"
                       value="{{ $productI->image }}" required>
                <div id="imagel" class="form-text">Please choose the product image.</div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="active" class="form-check-input" id="status">
                <label class="form-check-label" for="status">Status</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@include('products.footer')
