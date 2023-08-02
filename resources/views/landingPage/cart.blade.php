@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Cart
@endpush

@push('customcss')
@endpush

@section('content-main')
<!-- Start Cart Area  -->
<div class="axil-product-cart-area axil-section-gap">
    <div class="container">
        <div class="axil-product-cart-wrap">
            <form method="post" id="data-master">
                @csrf
                <div class="product-table-heading">
                    <h4 class="title">Keranjang Anda</h4>
                    <a href="{{ url('cart/clearAll') }}" class="cart-clear">Hapus Keranjang Belanja</a>
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-cart-table mb--40" id="tableCart">
                        <thead>
                            <tr>
                                <th scope="col" class="product-remove"></th>
                                <th scope="col" class="product-thumbnail">Produk</th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-price">Harga</th>
                                <th scope="col" class="product-quantity">Kuantitas</th>
                                <th scope="col" class="product-subtotal">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                            <tr>
                                <td class="product-remove"><a
                                        href="#"
                                        class="remove-wishlist" data-id="{{ $item->id }}"  id="buton_delete"><i class="fal fa-times"></i></a></td>
                                <td class="product-thumbnail">
                                    @if($item->attributes->image && $item->attributes->image!== '')
                                        <img height="100px"
                                             src="{{asset('storage/products/'.$item->attributes->image)}}">
                                    @else
                                        <img src="https://via.placeholder.com/150"
                                             height="100px">
                                    @endif
                                </td>
                                <td class="product-title"><a href="#">{{ $item->name }}</a>
                                </td>
                                <td class="product-price" data-title="Price">
                                    {{ "Rp " . number_format($item->price, 0, ",", ".") }}</td>
                                <td class="product-quantity" data-title="Qty">
                                    <div class="pro-qty">
                                        <input type="number" class="quantity-input" min="1"
                                            value="{{ $item->quantity }}" name="quantity">
                                    </div>
                                </td>
                                <td class="product-price" data-title="Price">
                                    {{ "Rp " . number_format($item->price * $item->quantity, 0, ",", ".") }}
                                
                                   <input type="hidden" name="id" value="{{ base64_encode($item->id) }}"></td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                        <tr>
                            <tr>
                                <td colspan="5" align="right">Total</td>
                                <td>{{ "Rp. " . number_format(Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".") }}</td>
                            </tr>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="cart-update-btn-area">
                    <div class="input-group product-cupon">
                        {{-- <input placeholder="Enter coupon code" type="text">
                        <div class="product-cupon-btn">
                            <button type="submit" class="axil-btn btn-outline">Apply</button>
                        </div> --}}
                    </div>
                    <div class="update-btn">
                        <input type="submit" id="updateCart" class="axil-btn btn-outline" value="Update Cart">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                        <div class="axil-order-summery mt--80">
                            <h5 class="title mb--20">Ringkasan Pesanan</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td>{{ "Rp. " . number_format(Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".") }}</td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>Total</td>
                                            <td class="order-total-amount">{{ "Rp. " . number_format(Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".") }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ url('checkout') }}" class="axil-btn btn-bg-primary checkout-btn">Checkout</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- End Cart Area  -->
@endsection

@push('customjs')
<script>
    
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });



        $('#data-master').on('submit', function (e) {
            e.preventDefault();
            $('#updateCart').val("Update...");
            $('#updateCart').attr('disabled', true);
            let data = $("#data-master").serialize();
            let datax = new FormData(this);
            // console.log(data[0].jenis_menu);
            console.log(data);
            $.ajax({
                type: "post",
                url: "{{url('/cart/update')}}",
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function()
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon Tunggu !',
                        html: 'Memperbaharui...',// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    
                    swal.close();
                    $('#updateCart').val("Update Cart");
                    $('#updateCart').removeAttr('disabled');
                    if (response.status == 1) {
                        $('#updateCart').val(`Update Cart`);
                        $('#updateCart').removeAttr('disabled');
                        window.location.reload();   
                    }
                },
                error: function (e) {
                    
                    swal.close();
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal !'
                    });
                    $('#updateCart').val(`Update Cart`);
                    $('#updateCart').removeAttr('disabled');

                }
            });
        });

    });
</script>
@endpush
