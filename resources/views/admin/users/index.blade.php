<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">USERS</h4>
				</div>
				<div class="card-body pt-0">
					<div class="pt-4">
						<div class="table-responsive">
							<table id="example4" class="display table" style="min-width: 845px">
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
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
