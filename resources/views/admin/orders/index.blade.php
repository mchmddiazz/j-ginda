@extends('layouts.admin.master')
@push('title')
Admin Abon Alfitri | Beranda
@endpush

@push('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link href="{{ asset('alert/css/sweetalert2.css')}}" rel="stylesheet" />
@endpush

@push('breadcrumb')
ORDER
@endpush

@section('content')
<div class="row">
    <!-- Column  -->
    <div class="col-lg-12">
        <div class="card dz-card">
            <div class="card-header flex-wrap border-0" id="default-tab">
                <h4 class="card-title">Order</h4>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="default-tab">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body pt-0">
                            </div>
            
                            <div class="table-responsive">
                                <table id="example4" class="display nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Order Number</th>
                                            <th>Pelanggan</th>
                                            <th>Total Harga</th>
                                            <th>Jumlah </th>
                                            <th>Status </th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<!-- Datatable -->
<script src="{{ asset('admin/') }}/js/plugins-init/datatables.init.js"></script>
<script src="{{ asset('alert/js/sweetalert.js') }}"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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


        var table = $('#example4').dataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ],
            dom: '<"top"<"pull-left"f><"pull-right"l>>rt<"bottom"<"pull-left"i><"pull-right"p>>',
            language: {
                processing: '<span style="color:black;">Mohon Tunggu...</span><i class="fa-solid fa-refresh fa-spin fa-3x fa-fw" style="color:#2510A3;"></i>',
                sEmptyTable: "Tidak Ada Data Yang Tersedia Pada Tabel Ini",
                sLengthMenu: "Tampilkan _MENU_ Baris",
                sZeroRecords: "Tidak Ditemukan Data Yang Sesuai",
                sInfo: "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Baris",
                sInfoEmpty: "Menampilkan 0 Sampai 0 Dari 0 Baris",
                sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                sInfoPostFix: "",
                sSearch: "Cari:",
                sUrl: "",
            },
            stateSave: true,
            order: [],
            ajax: "{{url('admin/orders')}}",
            deferRender: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'order_number',
                    name: 'order_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total'
                },
                {
                    data: 'item_count',
                    name: 'item_count'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(this).on('click', '#buttonUpdate', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Ubah Pesanan Menjadi Expired ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonText: 'Expired <i class="fa-solid fa-calendar me-2"></i>',
                cancelButtonText: 'Batal <i class="fa-solid fa-close me-2"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('admin/orders/updateStatus')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
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
                            let oTable = $('#example4').dataTable();
                            oTable.fnDraw(false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pesanan Berhasil Diperbaharui !',
                            });
                        },
                        error: function () {
                            
                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                text: 'Gagal memperbaharui data !'
                            })
                        }
                    });
                }
            })
        });

        $(this).on('click', '#buttonAccept', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah anda yakin akan mengkonfirmasi pembayaran ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonText: 'Konfirmasi <i class="fa-solid fa-check me-2"></i>',
                cancelButtonText: 'Batal <i class="fa-solid fa-close me-2"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('admin/orders/updateAccept')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        beforeSend: function()
                        {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Mengkonfirmasi...',// add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function (response) {
                            swal.close();
                            let oTable = $('#example4').dataTable();
                            oTable.fnDraw(false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pesanan Berhasil Dikonfirmasi !',
                            });
                        },
                        error: function () {
                            
                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                text: 'Gagal mengkonfirmasi data !'
                            })
                        }
                    });
                }
            })
        });

        $(this).on('click', '#buttonCancel', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah anda yakin membatalkan orderan ini ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonText: 'Batalkan <i class="fa-solid fa-check me-2"></i>',
                cancelButtonText: 'Batal <i class="fa-solid fa-close me-2"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('admin/orders/updateCancel')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        beforeSend: function()
                        {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Membatalkan...',// add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function (response) {
                            swal.close();
                            let oTable = $('#example4').dataTable();
                            oTable.fnDraw(false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pesanan Berhasil Dibatalkan !',
                            });
                        },
                        error: function () {
                            
                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                text: 'Gagal Membatalkan data !'
                            })
                        }
                    });
                }
            })
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
                        url: `{{url('admin/invoice/generate')}}/${id}`,
                        data: data,
                        xhrFields: {
                            responseType: 'blob'
                        },
                        beforeSend: function()
                        {
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
                        success: function(response){
                      
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

                            error: function(blob){

                            swal.close();
                            console.log(blob);

                        }
                    });
                }
            })
        });

    });

</script>
@endpush
