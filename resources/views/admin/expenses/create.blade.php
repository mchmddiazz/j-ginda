<x-admin.layout>

	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "Produk"}}</h4>
				</div>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="DefaultTab" role="tabpanel" aria-labelledby="home-tab">
						<div class="card-body pt-0">
							<!-- Nav tabs -->
							<div class="pt-4">
								<div class="basic-form">
									<form class="form-valide-with-icon needs-validation"
									      enctype="multipart/form-data" novalidate id="data-master" method="POST"
									      action="{{route('admin.expenses.store')}}">
										@csrf
										<div class="row g-3 mb-3">
											<div class="col-md-6">
												<label for="description" class="form-label">Deskripsi</label>
												<input type="text" class="form-control" id="description"
												       name="description">
											</div>
											<div class="col-md-6">
												<label for="amount" class="form-label">Amount</label>
												<input type="number" class="form-control" id="amount" name="amount">
											</div>
											<div class="col-md-12">
												<label for="type" class="form-label">Tipe Transaksi</label>
												<select id="type" class="default-select  form-control wide"
												        name="type">
													<option value="debit">Debit</option>
													<option value="credit">Credit</option>
												</select>
											</div>
										</div>

										<button type="submit" class="btn me-2 btn-primary"
										        id="simpan-data">Simpan Transaksi
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
