<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">USERS</h4>
				</div>
				<div class="card-body pt-0">
					<a href="{{route('admin.users.create')}}" type="button" class="btn btn-primary btn-sm">Tambah Data User</a>
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
										<th>Aksi</th>
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
											<td>
												<div class="d-grid gap-2 d-md-block">
													<a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-success btn-sm" type="button">Edit</a>
													<button class="btn btn-primary" type="button">Button</button>
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
