<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">


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
                        <td>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-primary" type="button">Update</button>
                                <button class="btn btn-danger" type="button">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>