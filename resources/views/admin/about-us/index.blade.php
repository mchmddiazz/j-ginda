@php use App\Enums\PermissionEnum; @endphp
<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "About Us"}}</h4>
				</div>
				<div class="card-body pt-0">
					@can(PermissionEnum::ABOUT_US_CREATE())
						<a href="{{route('admin.about.us.create')}}" class="btn btn-primary btn-sm">Tambah About Us</a>
					@endcan

					@if($aboutUs->count() === 0)
						<x-admin.empty-data></x-admin.empty-data>
					@else
						<div class="pt-4">
							<div class="table-responsive">
								<table class="table">
									<thead>
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Image</th>
										<th>Alamat</th>
										<th>Email</th>
										<th>No Telp</th>
										<th>Tanggal Dibuat</th>
										@canany([PermissionEnum::ABOUT_US_EDIT(), PermissionEnum::ABOUT_US_DESTROY()])
										<th>Aksi</th>
										@endcanany
									</tr>
									</thead>
									<tbody>
									@foreach($aboutUs as $key => $about)
										<tr>
											<td>{{$aboutUs->firstItem()+$key}}</td>
											<td>{{$about->name}}</td>
											<td>
												<img src='{{asset("storage/about-us/$about->image")}}' alt="Site Logo"
												     style="height: 95px;">
											</td>
											<td>{{$about->address}}</td>
											<td>{{$about->email}}</td>
											<td>{{$about->phone_number}}</td>
											<td>{{$about->created_at}}</td>
											@canany([PermissionEnum::ABOUT_US_EDIT(), PermissionEnum::ABOUT_US_DESTROY()])
												<td>
													<div class="d-grid gap-2 d-md-block">
														@can(PermissionEnum::ABOUT_US_EDIT())
															<a href="{{route('admin.about.us.edit', $about->id)}}"
															   class="btn btn-success btn-sm">Edit</a>
														@endcan

														@can(PermissionEnum::ABOUT_US_DESTROY())
															<button class="btn btn-danger btn-sm btn-delete"
															        data-id="{{$about->id}}" type="button">Hapus
															</button>
														@endcan
													</div>
												</td>
											@endcanany
										</tr>
									@endforeach
									</tbody>
								</table>
								{{$aboutUs->withQueryString()->links()}}
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<form id="form-delete" action="{{route('admin.about.us.destroy', ':id') }}" class="d-none" method="POST">
		@csrf
		@method("DELETE")
	</form>

	@push("js")
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
            function changeFormUrlWithId(id, defaultUrl, formSelector) {
                const newUrl = defaultUrl.replace(":id", id);
                $(formSelector).attr("action", newUrl);
            }

            function alertConfirm(successCallback, newConfig) {
                let config = {
                    title: 'Apakah anda yakin ?',
                    text: "Ketika dihapus anda tidak dapat membatalkannya !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus !',
                    cancelButtonText: 'Batalkan !'
                };

                if (newConfig != undefined) {
                    config = {...config, ...newConfig}
                }

                Swal.fire(config).then((result) => {
                    if (result.isConfirmed && typeof successCallback == "function") {
                        successCallback();
                    }
                })
            }

            let defaultDeleteUrl = $("#form-delete").attr("action");

            $(".btn-delete").on("click", function () {
                changeFormUrlWithId($(this).data("id"), defaultDeleteUrl, "#form-delete");

                alertConfirm(() => {
                    $("#form-delete").trigger("submit");
                })
            });
		</script>

	@endpush
</x-admin.layout>