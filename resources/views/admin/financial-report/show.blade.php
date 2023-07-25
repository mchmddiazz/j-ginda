<x-admin.layout>
	<div class="row">
		<!-- Column  -->
		<div class="col-lg-12">
			<div class="card dz-card">
				<div class="card-header flex-wrap border-0" id="default-tab">
					<h4 class="card-title">{{$cardTitle ?? "Laporan Keuangan"}}</h4>
				</div>
				<div class="card-body pt-0">
					<div class="p-4">
						<form class="row g-3" method="GET" action="{{route('admin.reports.generate.report')}}">
							<div class="col-md-4">
								<label for="year" class="form-label">Tahun</label>
								<select id="year" class="form-select" name="year">
									@for($i=2023; $i<2050; $i++)
										<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
							</div>
							<div class="col-md-4">
								<label for="month" class="form-label">Bulan</label>
								<select id="month" class="form-select" name="month">
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Generate Laporan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</x-admin.layout>
