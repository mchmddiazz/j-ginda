<x-landing.layout>
	<!-- Start Checkout Area  -->
	<div class="axil-checkout-area axil-section-gap">
		<div class="container">
			<form id="data-master">
				@csrf
				<div class="row">
					<div class="col-lg-6">
						@php
							$splitName = explode(' ', Auth::user()->name, 2);
							$first_name = $splitName[0];
							$last_name = !empty($splitName[1]) ? $splitName[1] : '';
						@endphp
						<div class="axil-checkout-billing">
							<h4 class="title mb--40">Detail Pemesanan</h4>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Email <span>*</span></label>
										<input type="email" name="email" value="{{ $user->email }}" id="email"
										       oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan Email Anda')">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Nama Depan <span>*</span></label>
										<input type="text" name="first_name" id="first_name" value="{{ $first_name }}"
										       oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan Nama Depan Anda')"
										       required
										       onkeypress='return harusHuruf(event)'>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Nama Belakang <span>*</span></label>
										<input type="text" name="last_name" id="last_name" value="{{ $last_name }}"
										       oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan Nama Lengkap Anda')"
										       required
										       onkeypress='return harusHuruf(event)'>
									</div>
								</div>
							</div>
							<div class="a1">

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Provinsi</label>
											<select name="province_id" id="province" oninput="setCustomValidity('')"
											        oninvalid="this.setCustomValidity('Mohon Masukan Provinsi')">

												<option value="-" selected disabled>Pilih Salah Satu</option>
												@foreach ($provinces as $province => $value)
													<option value="{{ $province  }}">{{ $value }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-label">Kota / Kabupaten</label>
											<select name="regency_id" id="regency">
											</select>
										</div>
									</div>

								</div>
								<div class="form-group">
									<label>Pilih Ekspedisi</label>
									<select name="kurir" id="kurir" oninput="setCustomValidity('')"
									        oninvalid="this.setCustomValidity('Mohon Masukan kurir')">
										<option value="">Pilih kurir</option>
										<option value="jne">JNE</option>
										<option value="tiki">TIKI</option>
										<option value="pos">POS INDONESIA</option>
									</select>
								</div>
								<div class="form-group">
									<label>Pilih Layanan</label>
									<select name="layanan" id="layanan" oninput="setCustomValidity('')"
									        oninvalid="this.setCustomValidity('Mohon Masukan Layanan')">
										<option value="">Pilih layanan</option>
									</select>
								</div>
								<div class="form-group">
									<label>Alamat <span>*</span></label>
									<input type="text" id="address1" name="address" class="mb--15"
									       value="{{ $user->address }}"
									       placeholder="Nomor rumah dan nama jalan" oninput="setCustomValidity('')"
									       oninvalid="this.setCustomValidity('Mohon Masukan Alamat Anda')">
								</div>
								<div class="form-group">
									<label>Kode Pos <span>*</span></label>
									<input type="text" id="post_code" name="post_code" value="{{ $user->postal_code }}"
									       onkeypress="return hanyaAngka(event)"
									       maxlength="6" oninput="setCustomValidity('')"
									       oninvalid="this.setCustomValidity('Mohon Masukan Kode Pos')">
								</div>
								<div class="form-group">
									<label>Phone <span>*</span></label>
									<input type="tel" name="phone_number" id="phone_number" value="{{ $user->phone }}"
									       onkeypress="return hanyaAngka(event)" maxlength="12"
									       oninput="setCustomValidity('')"
									       oninvalid="this.setCustomValidity('Mohon Masukan No. Telp Anda')">
								</div>
							</div>
							<div class="form-group different-shippng">
								<div class="toggle-bar">
									<a href="javascript:void(0)" class="toggle-btn">
										<input type="checkbox" id="checkbox2" name="diffrent-ship">
										<label for="checkbox2">Kirim ke alamat yang berbeda ?</label>
									</a>
								</div>
								<div class="toggle-open">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Provinsi</label>
												<select name="province_id2" id="province2">

													<option value="-" selected disabled>Pilih Salah Satu</option>
													@foreach ($provinces as $province => $value)
														<option value="{{ $province  }}">{{ $value }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="form-label">Kota / Kabupaten</label>
												<select name="regency_id2" id="regency2">
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label>Pilih Expedisi</label>
										<select name="kurir2" id="kurir2">
											<option value="">Pilih kurir</option>
											<option value="jne">JNE</option>
											<option value="tiki">TIKI</option>
											<option value="pos">POS INDONESIA</option>
										</select>
									</div>
									<div class="form-group">
										<label>Pilih Layanan</label>
										<select name="layanan2" id="layanan2">
											<option value="">Pilih layanan</option>
										</select>
									</div>
									<div class="form-group">
										<label>Alamat <span>*</span></label>
										<input type="text" id="address1" name="address1" class="mb--15"
										       placeholder="Nomor rumah dan nama jalan" oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan Alamat Anda')">
										<input type="text" id="address22" name="address22"
										       placeholder="Apartemen, suite, unit, dll. (optonal)">
									</div>
									<div class="form-group">
										<label>Kode Pos</label>
										<input type="text" id="post_code" name="post_code2"
										       onkeypress="return hanyaAngka(event)" maxlength="6"
										       oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan Kode Pos')">
									</div>
									<div class="form-group">
										<label>Phone <span>*</span></label>
										<input type="tel" name="phone_number2" id="phone_number2"
										       onkeypress="return hanyaAngka(event)" maxlength="12"
										       oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan No. Telp Anda')">
									</div>
									<div class="form-group">
										<label>Email <span>*</span></label>
										<input type="email" name="email2" id="email2" oninput="setCustomValidity('')"
										       oninvalid="this.setCustomValidity('Mohon Masukan Email Anda')">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Other Notes (optional)</label>
								<textarea id="notes" name="notes" rows="2"
								          placeholder="Catatan tentang pesanan Anda, misalnya catatan khusus untuk pengiriman."></textarea>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="axil-order-summery order-checkout-summery">
							<h5 class="title mb--20">Ringkasan Pesanan</h5>
							<div class="summery-table-wrap">
								<table class="table summery-table">
									<thead>
									<tr>
										<th>Produk</th>
										<th>Subtotal</th>
									</tr>
									</thead>
									<tbody>
									@foreach ($carts as $item)
										<tr class="order-product">
											<td>{{ $item->name }}<span class="quantity">{{ $item->quantity }} x</span>
											</td>
											<td>{{ $item->weight }} {{ "Rp. " . number_format($item->price * $item->quantity, 0, ",", ".") }}
											</td>
										</tr>
										<input type="hidden" id="id" name="id" value="{{ base64_encode($item->id) }}">
									@endforeach
									<tr class="order-total">
										<td>Total Ongkos Kirim</td>
										<td class="order-total-amount ongkir">
										</td>
									</tr>
									<tr class="order-total">
										<td>Total</td>
										<td class="order-total-amount totalKirim">
											{{ "Rp. " . number_format(Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".") }}</td>
									</tr>
									</tbody>
								</table>
							</div>
							<div class="order-payment-method">
								<div class="single-payment">
									<h5 class="title mb--20">Pembayaran</h5>
									<h6 class="title mb--20">Semua transaksi sudah diamankan dan dienkripsi.</h6>
									<hr style="border: 1px solid;">
									<div class="input-group">
										<input type="radio" id="radio4" name="payment" value="Payment Gateway">
										<label for="radio4">Transfer Bank</label>
									</div>
									<p>Setelah mengeklik “Checkout”, Anda akan diarahkan ke Payments via Midtrans untuk
										menyelesaikan proses pembayaran secara aman.</p>
								</div>
							</div>
							<input type="hidden" name="alamat2" value="" id="alamat2">
							<input type="hidden" name="expedisi" value="" id="expedisi">
							<input type="hidden" name="totalpayment" value="" id="totalpayment">
							<input type="hidden" name="ongkir" value="" id="ongkirValue">
							<input type="hidden" name="weight" value="{{ $weight }}" id="weight">

							<button type="submit" class="axil-btn btn-bg-primary checkout-btn"
							        id="checkoutBTN">Checkout
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- End Checkout Area  -->

	@push('js')
		<script>
            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }

            function harusHuruf(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 32)
                    return false;
                return true;
            }


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

                $(document).on('change', '#province', function () {
                    let id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: `{{url('/getKabupaten')}}/${id}`,
                        dataType: "json",
                        success: function (response) {
                            $("#regency").html(response.res);
                        }
                    });
                });

                $(document).on('change', '#province2', function () {
                    let id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: `{{url('/getKabupaten')}}/${id}`,
                        dataType: "json",
                        success: function (response) {
                            $("#regency2").html(response.res);
                        }
                    });
                });


                $('select[name="kurir"]').on('change', function () {
                    let token = $("meta[name='csrf-token']").attr("content");
                    let origin = $("select[name=province_id]").val();
                    let destination = $("select[name=regency_id]").val();
                    let courier = $("select[name=kurir]").val();
                    let weight = $("input[name=weight]").val();

                    // create array for checking kurir
                    if (courier) {
                        jQuery.ajax({
                            url: "{{ url('/ongkir') }}",
                            data: {
                                _token: token,
                                city_origin: origin,
                                city_destination: destination,
                                courier: courier,
                                weight: weight,
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function (response) {
                                $('select[name="layanan"]').empty();
                                $.each(response[0]['costs'], function (key, value) {
                                    $('select[name="layanan"]')
                                        .append('<option value="' +
                                            value.cost[0].value + '">' + response[0].code.toUpperCase() + ':' + ' ' + value.service + ' ' + '-' + ' ' + 'Rp ' + ' ' + ' ' + value.cost[0].value + ' ' + '-' + ' ' +
                                            value.cost[0].etd + ' ' + 'Hari' +
                                            '</option>')

                                    $('select[name="layanan"]').change();
                                    $("#expedisi").val(response[0].code.toUpperCase());
                                });
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    } else {
                        $('select[name="layanan"]').empty();
                    }
                });

                $('select[name="layanan"]').on('change', function () {
                    let token = $("meta[name='csrf-token']").attr("content");
                    let layanan = $("select[name=layanan]").val();

                    jQuery.ajax({
                        url: "{{ url('/getTotalOngkir') }}",
                        data: {
                            _token: token,
                            layanan: layanan
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function (response) {
                            $(".ongkir").html(response.ongkir);
                            $(".totalKirim").html(response.totalKirim);
                            $("#totalpayment").val(response.totalpayment);
                            $("#ongkirValue").val(response.ongkirPayment);
                        }
                    });

                });

                $('select[name="layanan2"]').on('change', function () {
                    let token = $("meta[name='csrf-token']").attr("content");
                    let layanan = $("select[name=layanan2]").val();

                    jQuery.ajax({
                        url: "{{ url('/getTotalOngkir') }}",
                        data: {
                            _token: token,
                            layanan: layanan
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function (response) {
                            $(".ongkir").html(response.ongkir);
                            $(".totalKirim").html(response.totalKirim);
                            $("#totalpayment").val(response.totalpayment);
                            $("#ongkirValue").val(response.ongkirPayment);
                        }
                    });

                });

                $('select[name="kurir2"]').on('change', function () {
                    let token = $("meta[name='csrf-token']").attr("content");
                    let origin = $("select[name=province_id2]").val();
                    let destination = $("select[name=regency_id2]").val();
                    let courier = $("select[name=kurir2]").val();
                    let weight = $("input[name=weight]").val();

                    if (courier) {
                        jQuery.ajax({
                            url: "{{ url('/ongkir') }}",
                            data: {
                                _token: token,
                                city_origin: origin,
                                city_destination: destination,
                                courier: courier,
                                weight: weight,
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function (response) {
                                $('select[name="layanan2"]').empty();
                                $.each(response[0]['costs'], function (key, value) {
                                    $('select[name="layanan2"]')
                                        .append('<option value="' +
                                            value.cost[0].value + '">' + response[0].code.toUpperCase() + ':' + ' ' + value.service + ' ' + '-' + ' ' + 'Rp ' + ' ' + ' ' + value.cost[0].value + ' ' + '-' + ' ' +
                                            value.cost[0].etd + ' ' + 'Hari' +
                                            '</option>')
                                    $('select[name="layanan2"]').change();
                                    $("#expedisi").val(response[0].code.toUpperCase());
                                });
                            },
                            error(error) {
                                console.log(error);
                            }
                        });
                    } else {
                        $('select[name="layanan2"]').empty();
                    }
                });

                function reset() {
                    $('input').val('');
                    $('select').val('');
                    $('textarea').val('');
                }

                $('#data-master').on('submit', function (e) {
                    e.preventDefault();
                    $('#checkoutBTN').val("Checkout...");
                    $('#checkoutBTN').attr('disabled', true);
                    let data = $("#data-master").serialize();
                    let datax = new FormData(this);
                    // console.log(data[0].jenis_menu);
                    console.log(data);
                    $.ajax({
                        type: "post",
                        url: "{{url('/checkout/postCheckout')}}",
                        data: datax,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Checkout...', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function (response) {
                            console.log(response);
                            $("#jenis_menuHelp").html("");
                            $('#checkoutBTN').val("Checkout");
                            $('#checkoutBTN').removeAttr('disabled');
                            if (response.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Berhasil Melakukan Pesanan!',
                                });
                                let orderId = response.orderId;
                                window.location.href = `{{ url('orders') }}/${orderId}`;
                            } else if (response.status == 3) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Metode Pembayaran Tidak Boleh Kosong!'
                                });
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Gagal Melakukan Pesanan!'
                                });
                            }
                        },
                        error: function (e) {
                            console.log(e.responseText)
                            Toast.fire({
                                icon: 'error',
                                title: 'Gagal !'
                            });
                            $('#checkoutBTN').val(`Checkout`);
                            $('#checkoutBTN').removeAttr('disabled');

                        }
                    });
                });

                $('#checkbox2').change(function () {
                    if (this.checked) {
                        $("#alamat2").val('yes');
                        $('.a1').hide();
                    } else {
                        $("#alamat2").val('no');
                        $('.a1').show();
                    }
                });
            });

		</script>
	@endpush

</x-landing.layout>


