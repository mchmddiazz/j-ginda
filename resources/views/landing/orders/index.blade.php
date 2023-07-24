<x-landing.layout>
	<div class="axil-product-cart-area axil-section-gap">
		<div class="container">
			<x-admin.alert></x-admin.alert>
			<div class="axil-product-cart-wrap">
				<form method="post" id="data-master">
					@csrf
					<div class="table-responsive">
						<table class="table axil-product-table axil-cart-table mb--40" id="tableCart">
							<thead>
							<tr>
								<th scope="col" class="product-title">#</th>
								<th scope="col" class="product-price">Total Harga</th>
								<th scope="col" class="product-subtotal">Status Pembayaran</th>
								<th scope="col" class="product-subtotal">Jasa Pengiriman</th>
								<th scope="col" class="product-status"></th>
							</tr>
							</thead>
							<tbody>
							@foreach ($orders as $order)
								<tr>
									<td class="product-title">
										{{ $order->order_number }}
									</td>
									<td class="product-price" data-title="Price">
										{{ formatToRupiah($order->grand_total) }}</td>

									<td class="product-subtotal">
										{{$order->payment_status}}
									</td>

									<td class="product-title"><a href="#">{{ $order->expedisi }}</a>
									<td>
										@if ($order->payment_status == 2)
											<a href="#" data-id="{{ $order->id }}" class="btn btn-danger"
											   data-order="{{ $order->order_number }}" id="buton_generate"><i
														class="fas fa-download"></i> Invoice</a>
										@elseif ($order->payment_status == 5)
											<a href="#" data-id="{{ $order->id }}" class="btn btn-danger"
											   data-order="{{ $order->order_number }}" id="buton_generate"><i
														class="fas fa-download"></i> Invoice</a>
										@endif
										<a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">
											Lihat
										</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>

	@push('js')
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

                $(this).on('click', '#buton_generate', function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let order = $(this).data('order');

                    var data = '';
                    Swal.fire({
                        title: 'Notifikasi',
                        text: "Apakah anda yakin akan men-generate invoice ini ?",
                        icon: 'question',
                        showCancelButton: true,
                        buttonsStyling: true,
                        confirmButtonClass: 'btn btn-danger btn-lg mr-2',
                        cancelButtonClass: 'btn btn-primary btn-lg',
                        confirmButtonText: 'Generate <i class="fas fa-download"></i>',
                        cancelButtonText: 'Batal <i class="fas fa-close"> </i>'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "GET",
                                url: `{{url('account/invoice/generate')}}/${id}`,
                                data: data,
                                xhrFields: {
                                    responseType: 'blob'
                                },
                                beforeSend: function () {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Mohon Tunggu !',
                                        html: 'Proses Generate...',// add html attribute if you want or remove
                                        allowOutsideClick: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                        },
                                    });
                                },
                                success: function (response) {

                                    swal.close();
                                    var blob = new Blob([response]);

                                    var link = document.createElement('a');

                                    link.href = window.URL.createObjectURL(blob);

                                    link.download = `invoice-${order}.pdf`;

                                    link.click();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Data Berhasil Digenerate !',
                                    });
                                },

                                error: function (blob) {
                                    swal.close();
                                }
                            });
                        }
                    })
                });

            });
		</script>
	@endpush
</x-landing.layout>

