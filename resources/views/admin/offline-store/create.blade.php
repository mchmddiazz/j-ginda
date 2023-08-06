<x-admin.layout>
    <div class="row">
        <!-- Column  -->
        <div class="col-lg-12">
            <div class="card dz-card">
                <div class="card-header flex-wrap border-0" id="default-tab">
                    <h4 class="card-title">{{$cardTitle ?? "About Us"}}</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="p-4">
                        <form class="row g-3" action="{{route('admin.offline.store.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="data-products" data-products="{{json_encode($products)}}"></div>
                            <div id="form-container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="product" class="form-label">Produk</label>
                                        <select name="product_ids[]" class="form-select">
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name . " | Rp " . $product->price}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="quantity" class="form-label">Kuantitas</label>
                                        <input type="number" min="0" class="form-control" name="quantity[]" id="quantity">
                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="button" id="tambah-row" class="btn btn-success">Tambah</button>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push("js")
        <script>
            $(function() {
                $("#tambah-row").on("click", function (){

                    const products = $("#data-products").data('products')

                    let options = '';
                    products.forEach(function (item){
                        console.log(item)
                        options += `
                            <option value="${item.id}">${item.name} | Rp ${item.price}</option>
                        `
                    })
                    $("#form-container").append(`
<div class="row">
                        <div class="col-md-6">
                                    <label for="product" class="form-label">Produk</label>
                                    <select name="product_ids[]" class="form-select">

`
                        +options+
                        `


                    </select>
                </div>
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Kuantitas</label>
                    <input type="number" min="0" class="form-control" name="quantity[]" id="quantity" >
                </div>
</div>

`)
                })
            });
        </script>
    @endpush

</x-admin.layout>