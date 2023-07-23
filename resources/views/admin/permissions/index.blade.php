<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">Permissions</h4>
				</div>
				<div class="card-body pt-0">
					@if($permissions->count()===0)
						<x-admin.empty-data></x-admin.empty-data>
					@else
						<div class="pt-4">
							<div class="table-responsive">
								<table class="table" style="min-width: 845px">
									<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Deskripsi</th>
										<th>Feature</th>
										<th>Nama Guard</th>
									</tr>
									</thead>
									<tbody>
									@foreach($permissions as $key => $permission)
										<tr>
											<td>{{$permissions->firstItem() + $key}}</td>
											<td>{{$permission->name}}</td>
											<td>{{$permission->description}}</td>
											<td>{{$permission->feature}}</td>
											<td>{{$permission->guard_name}}</td>
										</tr>
									@endforeach
									</tbody>
								</table>
								{{$permissions->withQueryString()->links()}}
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
