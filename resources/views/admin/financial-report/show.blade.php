<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "Roles"}}</h4>
				</div>
				<div class="card-body pt-0">
					<div class="p-4">
						<form class="row g-3" action="{{route('admin.roles.update', $role->id)}}" method="POST">
							@csrf
							@method("PUT")
							<div class="col-md-6">
								<label for="name" class="form-label">Nama</label>
								<input type="text" class="form-control" id="name" name="name" value="{{$role->name}}"
								       disabled>
							</div>
							<div class="col-md-12">
								<div class="permission mt-4">
									@foreach ($permissions as $key => $permissionGroup)
										<h5>{{ucwords($key)}}</h5>
										<hr>
										@foreach($permissionGroup as $subKey => $permission)
											<div class="form-check form-switch form-check-inline">
												<input name="permissions[]" class="form-check-input" type="checkbox"
												       value="{{ $permission->name }}"
												       @if($permission->is_active) checked
												       @endif id="permission{{ $permission->id }}">
												<label class="form-check-label"
												       for="permission{{ $permission->id }}">{{ $permission->description }}</label>
											</div>
										@endforeach
										<br>
										<br>
									@endforeach
								</div>
								{{--								@foreach($roles as $key => $role)--}}
								{{--									<div class="form-check">--}}
								{{--										<input class="form-check-input" type="checkbox" @if($user->hasRole($role->name)) checked @endif id="role" name="roles[]" value="{{$role->id}}">--}}
								{{--										<label class="form-check-label" for="role">--}}
								{{--											{{$role->name}}--}}
								{{--										</label>--}}
								{{--									</div>--}}
								{{--								@endforeach--}}
							</div>
							<div class="col-12">
								<a href="{{route('admin.roles.index')}}" class="btn btn-secondary">Kembali</a>
								<button type="submit" class="btn btn-primary">Update Data Role</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
