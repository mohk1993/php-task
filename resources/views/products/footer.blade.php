<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @if(request()->is('price-history/'.$productInfo->id))
    {
        {!! $priceChart->script() !!}
    }
    @endif
<script>
    $(document).ready(function () {
        $('#productInfo a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>
</body>
</html>
