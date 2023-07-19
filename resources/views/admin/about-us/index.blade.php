<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "About Us"}}</h4>
				</div>

				<button type="button" class="btn btn-primary">Primary</button>
				@if($aboutUs->count() === 0)
					<x-admin.empty-data></x-admin.empty-data>
				@else
					<div class="card-body pt-0">
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
										<th>Aksi</th>
									</tr>
									</thead>
									<tbody>
									@foreach($aboutUs as $key => $about)
										<tr>
											<td>{{$aboutUs->firstItem()+$key}}</td>
											<td>{{$about->name}}</td>
											<td>
												<img src='{{asset("about/$about->image")}}' alt="Site Logo" style="height: 95px;">
											</td>
											<td>{{$about->address}}</td>
											<td>{{$about->email}}</td>
											<td>{{$about->phone_number}}</td>
											<td>{{$about->created_at}}</td>
											<td>Aksi</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

</x-admin.layout>