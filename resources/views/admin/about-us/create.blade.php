<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "About Us"}}</h4>
				</div>
				<div class="card-body pt-0">
					<div class="p-4">
						<form class="row g-3" method="POST" action="{{route('admin.about.us.store')}}" enctype="multipart/form-data">
							@csrf
							<div class="col-md-4">
								<label for="name" class="form-label">Judul</label>
								<input type="text" class="form-control" id="name" name="name">
							</div>
							<div class="col-md-4">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
							<div class="col-md-4">
								<label for="phone_number" class="form-label">Nomor Hp</label>
								<input type="text" class="form-control" id="phone_number" name="phone_number">
							</div>
							<div class="col-md-6">
								<label for="description" class="form-label">Deskripsi</label>
								<textarea  class="form-control" id="description" name="description"></textarea>
							</div>
							<div class="col-md-6">
								<label for="address" class="form-label">Alamat</label>
								<textarea  class="form-control" id="address" name="address"></textarea>
							</div>
							<div class="col-md-6">
								<label for="image" class="form-label">Gambar</label>
								<input class="form-control" type="file" id="image" name="image">
							</div>
							<div class="col-12">
								<a href="{{route('admin.about.us.index')}}" class="btn btn-secondary">Kembali</a>
								<button type="submit" class="btn btn-primary">Tambah About Us</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</x-admin.layout>