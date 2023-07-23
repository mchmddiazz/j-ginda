<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle}}</h4>
				</div>
				<div class="card-body pt-0">
					@if($roles->count()===0)
						<x-admin.empty-data></x-admin.empty-data>
					@else
						<div class="pt-4">
							<div class="table-responsive">
								<table class="table" style="min-width: 845px">
									<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Aksi</th>
									</tr>
									</thead>
									<tbody>
									@foreach($roles as $key => $role)
										<tr>
											<td>{{$roles->firstItem() + $key}}</td>
											<td>{{$role->name}}</td>
											<td>
												<div class="d-grid gap-2 d-md-block">
													<a href="{{route('admin.roles.edit', $role->id)}}"
													   class="btn btn-success btn-sm" type="button">Edit</a>
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
								{{$roles->withQueryString()->links()}}
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
