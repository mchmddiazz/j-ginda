@php use App\Enums\PermissionEnum; @endphp
<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">USERS</h4>
				</div>
				<div class="card-body pt-0">
					@can(PermissionEnum::USERS_CREATE())
						<a href="{{route('admin.users.create')}}" type="button" class="btn btn-primary btn-sm">Tambah
							Data
							User</a>
					@endcan
					@if($users->count()===0)
						<x-admin.empty-data></x-admin.empty-data>
					@else
						<div class="pt-4">
							<div class="table-responsive">
								<table class="table" style="min-width: 845px">
									<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Role</th>
										@canany([PermissionEnum::USERS_EDIT(), PermissionEnum::USERS_DESTROY()])
											<th>Aksi</th>
										@endcanany
									</tr>
									</thead>
									<tbody>
									@foreach($users as $key => $user)
										<tr>
											<td>{{$users->firstItem() + $key}}</td>
											<td>{{$user->name}}</td>
											<td>{{$user->email}}</td>
											<td>
												@foreach($user->roles as $subKey => $role)
													{{"$role->name,"}}
												@endforeach
											</td>
											@canany([PermissionEnum::USERS_EDIT(), PermissionEnum::USERS_DESTROY()])
												<td>
													<div class="d-grid gap-2 d-md-block">
														@can(PermissionEnum::USERS_EDIT())
															<a href="{{route('admin.users.edit', $user->id)}}"
															   class="btn btn-success btn-sm" type="button">Edit</a>
														@endcan

														@can(PermissionEnum::USERS_DESTROY())
															<button data-id="{{$user->id}}"
															        class="btn btn-danger btn-sm btn-delete"
															        type="button">
																Hapus
															</button>
														@endcan
													</div>
												</td>
											@endcanany
										</tr>
									@endforeach
									</tbody>
								</table>
								{{$users->withQueryString()->links()}}
							</div>
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>

	<form id="form-delete" action="{{route('admin.users.destroy', ':id') }}" class="d-none" method="POST">
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
