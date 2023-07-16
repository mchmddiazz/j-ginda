@extends('layouts.admin.master')
@push('title')
Admin Abon Alfitri | USERS
@endpush

@push('css')

<link href="{{ asset('admin/') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('alert/css/sweetalert2.css')}} " rel="stylesheet" />
@endpush

@push('breadcrumb')
USERS
@endpush

@section('content')
<!--element-area -->

<div class="row">
    <!-- Column  -->
    <div class="col-lg-12">
        <div class="card dz-card">
            <div class="card-header flex-wrap border-0" id="default-tab">
                <h4 class="card-title">USERS</h4>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="DefaultTab" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body pt-0">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home"><i
                                            class="la la-table me-2"></i> List Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile"><i
                                            class="la la-plus me-2"></i> Tambah Users</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="pt-4">

                                        <div class="table-responsive">
                                            <table id="example4" class="display table" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Tanggal</th>
                                                        <th>Login Terakhir</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <div class="pt-4">
                                        <div class="basic-form">
                                            <form class="form-valide-with-icon needs-validation"
                                                enctype="multipart/form-data" novalidate id="data-master">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="text-label form-label"
                                                        for="validationCustomUsername">Nama</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                        </span>
                                                        <input type="text" name="name" class="form-control"
                                                            id="validationCustomUsername"
                                                            placeholder="Enter a name.." required>
                                                        <div class="invalid-feedback">
                                                            Please Enter a Title.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-label form-label"
                                                        for="validationCustomUsername">Email</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">@
                                                        </span>
                                                        <input type="email" name="email" class="form-control"
                                                            id="validationCustomUsername"
                                                            placeholder="Enter a email.." required>
                                                        <div class="invalid-feedback">
                                                            Please Enter a Email.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-label form-label"
                                                        for="validationCustomUsername">Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-lock"></i>
                                                        </span>
                                                        <input type="password" name="password" id="dz-password" class="form-control"
                                                            placeholder="Enter a password.." required>
                                                            <span class="input-group-text show-pass"> 
                                                                <i class="fa fa-eye-slash"></i>
                                                                <i class="fa fa-eye"></i>
                                                            </span>
                                                        <div class="invalid-feedback">
                                                            Please Enter a Password.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-label form-label"
                                                        for="validationCustomUsername">Confirm Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-lock"></i>
                                                        </span>
                                                        <input type="password" name="confirm_password" id="confirm-password" class="form-control"
                                                            placeholder="Enter a password.." required>
                                                            <span class="input-group-text show-pass"> 
                                                                <i class="fa fa-eye-slash"></i>
                                                                <i class="fa fa-eye"></i>
                                                            </span>
                                                        <div class="invalid-feedback">
                                                            Please Enter a Confirm Password.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Role (select one):</label>
                                                    <select class="default-select form-control wide" name="role" id="role">
                                                        <option value="1">Admin</option>
                                                        <option value="2">User</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="user_id" id="users_id">
                                                <button type="submit" class="btn me-2 btn-primary"
                                                    id="simpan-data">Tambah</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <form class="form-valide-with-icon needs-validation" enctype="multipart/form-data" novalidate
                id="data-master-edit">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="text-label form-label"
                            for="validationCustomUsername">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text">
                            </span>
                            <input type="text" name="name" class="form-control"
                                id="nameEdit"
                                placeholder="Enter a name.." required>
                            <div class="invalid-feedback">
                                Please Enter a Title.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-label form-label"
                            for="validationCustomUsername">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">@
                            </span>
                            <input type="email" name="email" class="form-control"
                                id="emailEdit"
                                placeholder="Enter a email.." required>
                            <div class="invalid-feedback">
                                Please Enter a Email.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-label form-label"
                            for="validationCustomUsername">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="dz-password" class="form-control"
                                placeholder="Enter a password.." required>
                                <span class="input-group-text show-pass"> 
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            <div class="invalid-feedback">
                                Please Enter a Password.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-label form-label"
                            for="validationCustomUsername">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i>
                            </span>
                            <input type="password" name="confirm_password" id="confirm-password" class="form-control"
                                placeholder="Enter a password.." required>
                                <span class="input-group-text show-pass"> 
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            <div class="invalid-feedback">
                                Please Enter a Confirm Password.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role (select one):</label>
                        <select class="default-select form-control wide" name="role" id="roleEdit">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" id="users_idEdit">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="simpan-data-edit">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- Datatable -->
<script src="{{ asset('admin/') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/') }}/js/plugins-init/datatables.init.js"></script>
<script src="{{ asset('alert/js/sweetalert.js') }}"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script src="{{ asset('admin/') }}/vendor/ckeditor/ckeditor.js"></script>
<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

</script>
<script>
    function readURL(input, id) {
        id = id || '#modal-preview';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    function readURLEdit(input, id) {
        id = id || '#modal-previewEdit';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

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
        $('.uang').mask('000.000.000.000.000', {
            reverse: true
        });

        function reset() {
            $('input').val('');
            $('select').val('');
            $('textarea').val('');
        }

        var SITEURL = '{{URL::to('')}}';
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
            dom: '<"top"<"pull-left"f><"pull-right"l>>rt<"bottom"<"pull-left"i><"pull-right"p>>',
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 4
                }
            ],
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
            ajax: "{{url('admin/users-list')}}",
            deferRender: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'last_login',
                    name: 'last_login'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(this).on('click', '#buton_hapus', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: "Apakah anda yakin ingin menghapus about ?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonText: 'Expired <i class="fa-solid fa-trash me-2"></i>',
                cancelButtonText: 'Batal <i class="fa-solid fa-close me-2"> </i>'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{url('admin/users-list/delete/')}}/${id}`,
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        dataType: "json",
                        beforeSend: function () {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Mohon Tunggu !',
                                html: 'Memperbaharui...', // add html attribute if you want or remove
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
                                text: 'Users Berhasil Dihapus !',
                            });
                        },
                        error: function () {

                            swal.close();
                            Toast.fire({
                                icon: 'error',
                                text: 'Gagal menghapus data !'
                            })
                        }
                    });
                }
            });
        });

        $('#data-master').on('submit', function (e) {
            e.preventDefault();
            $('#simpan-data').val("Tambah...");
            $('#simpan-data').attr('disabled', true);
            let data = $("#data-master").serialize();
            let datax = new FormData(this);
            // console.log(data[0].jenis_menu);
            console.log(data);
            $.ajax({
                type: "post",
                url: "{{url('/admin/users-list/store')}}",
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon Tunggu !',
                        html: 'Tambah About...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    $('#simpan-data').val("Tambah");
                    $('#simpan-data').removeAttr('disabled');
                    if (response.status == 1) {
                        swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Menambah Users!',
                        });
                        reset();
                        window.location.href = `{{ url('admin/users-list') }}`;
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Gagal!'
                        });
                    }
                },
                error: function (e) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal !'
                    });
                    $('#simpan-data').val(`Tambah`);
                    $('#simpan-data').removeAttr('disabled');

                }
            });
        });


        $('#data-master-edit').on('submit', function (e) {
            e.preventDefault();
            $('#simpan-data-edit').val("Update...");
            $('#simpan-data-edit').attr('disabled', true);
            let data = $("#data-master-edit").serialize();
            let datax = new FormData(this);
            // console.log(data[0].jenis_menu);
            console.log(data);
            $.ajax({
                type: "post",
                url: "{{url('/admin/users-list/store')}}",
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon Tunggu !',
                        html: 'Tambah About...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function (response) {
                    $('#simpan-data-edit').val("Update");
                    $('#simpan-data-edit').removeAttr('disabled');
                    if (response.status == 1) {
                        let oTable = $('#example4').dataTable();
                        oTable.fnDraw(false);
                        swal.close();                    
                        $("#modelId").modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Memperbaharui Users!',
                        });
                        reset();
                    }  else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Gagal!'
                        });
                    }
                },
                error: function (e) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal !'
                    });
                    $('#simpan-data-edit').val(`Update`);
                    $('#simpan-data-edit').removeAttr('disabled');

                }
            });
        });

        $(this).on('click', "#buton_edit", function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "get",
                url: `{{url('admin/users-list/edit')}}/${id}`,
                dataType: "json",
                success: function (response) {
                    $("#users_idEdit").val(response.id_user);
                    $("#nameEdit").val(response.name);
                    $("#emailEdit").val(response.email);
                    if (response.role_id == 2) {
                        $('#roleEdit')
                        .val('2')
                        .trigger('change');
                    } else if(response.role_id == 1) {
                        $('#roleEdit')
                        .val('1')
                        .trigger('change');
                    }

                },
                error: function () {
                    Toast.fire({
                        type: 'error',
                        title: 'Gagal mengambil data !'
                    })
                }
            });
            $(".modal-title").html("Ubah Data Users");
        });
    });

</script>
@endpush
