<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">USERS</h4>
				</div>
				<div class="card-body pt-0">
					<div class="p-4">
						<form class="row g-3" action="{{route('admin.users.store')}}" method="POST">
							@csrf
							<div class="col-md-6">
								<label for="name" class="form-label">Nama</label>
								<input type="text" class="form-control" id="name" name="name">
							</div>
							<div class="col-md-6">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
							<div class="col-md-6">
								<label for="postal_code" class="form-label">Kode Pos</label>
								<input type="text" class="form-control" id="postal_code" name="postal_code">
							</div>
							<div class="col-md-6">
								<label for="phone" class="form-label">Phone</label>
								<input type="text" class="form-control" id="phone" name="phone">
							</div>
							<div class="col-md-12">
								<label for="address" class="form-label">Alamat</label>
								<textarea class="form-control" name="address" id="address"></textarea>
							</div>
							<div class="col-md-6">
								<label for="password" class="form-label">Password</label>
								<input type="password" class="form-control" id="password" name="password">
							</div>
							<div class="col-md-6">
								<label for="password_confirmation" class="form-label">Konfirmasi Password</label>
								<input type="password" class="form-control" id="password_confirmation"
								       name="password_confirmation">
							</div>
							<div class="col-md-6">
								@foreach($roles as $key => $role)
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="role" name="roles[]" value="{{$role->id}}">
										<label class="form-check-label" for="role">
											{{$role->name}}
										</label>
									</div>
								@endforeach
							</div>
							<div class="col-12">
								<a href="{{route('admin.users.index')}}" class="btn btn-secondary">Kembali</a>
								<button type="submit" class="btn btn-primary">Tambah Data User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
