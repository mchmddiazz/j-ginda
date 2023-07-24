@php use App\Enums\PermissionEnum;use App\Enums\RoleEnum; @endphp
<div class="deznav">
	<div class="deznav-scroll">
		<ul class="metismenu" id="menu">
			<li class="menu-title">YOUR COMPANY</li>
			<li>
				<a href="{{ url('admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"
				   aria-expanded="false">
					<div class="menu-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
							      fill="#90959F"/>
						</svg>
					</div>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>
			@can(PermissionEnum::ABOUT_US_INDEX())
				<li>
					<a href="{{ route("admin.about.us.index") }}"
					   class="{{ request()->is('admin/aboutus-list') ? 'active' : '' }}"
					   aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
								      fill="#90959F"/>
							</svg>
						</div>
						<span class="nav-text">About Us</span>
					</a>
				</li>
			@endcan

			@can(PermissionEnum::PERMISSIONS_INDEX())
				<li>
					<a href="{{ route("admin.permissions.index") }}"
					   class="{{ request()->is(route('admin.permissions.index')) ? 'active' : '' }}"
					   aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
								      fill="#90959F"/>
							</svg>
						</div>
						<span class="nav-text">Permissions</span>
					</a>
				</li>
			@endcan
			@can(PermissionEnum::ROLES_INDEX())
				<li>
					<a href="{{ route("admin.roles.index") }}"
					   class="{{ request()->is(route('admin.permissions.index')) ? 'active' : '' }}"
					   aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
								      fill="#90959F"/>
							</svg>
						</div>
						<span class="nav-text">Roles</span>
					</a>
				</li>
			@endcan
			@can(PermissionEnum::USERS_INDEX())
				<li>
					<a href="{{ route('admin.users.index') }}"
					   class="{{ request()->is('admin/aboutus-list') ? 'active' : '' }}"
					   aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
								      fill="#90959F"/>
							</svg>
						</div>
						<span class="nav-text">User</span>
					</a>
				</li>
			@endcan

			<li class="menu-title">OUR FEATURES</li>
			{{-- PRODUK --}}

			@canany([PermissionEnum::ADMIN_PRODUCTS_INDEX(), PermissionEnum::ADMIN_PRODUCTS_LOW_QUANTITY()])
				<li>
					<a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<g opacity="0.5">
									<path opacity="0.4"
									      d="M2.00018 11.0785C2.05018 13.4165 2.19018 17.4155 2.21018 17.8565C2.28118 18.7995 2.64218 19.7525 3.20418 20.4245C3.98618 21.3675 4.94918 21.7885 6.29218 21.7885C8.14818 21.7985 10.1942 21.7985 12.1812 21.7985C14.1762 21.7985 16.1122 21.7985 17.7472 21.7885C19.0712 21.7885 20.0642 21.3565 20.8362 20.4245C21.3982 19.7525 21.7592 18.7895 21.8102 17.8565C21.8302 17.4855 21.9302 13.1445 21.9902 11.0785H2.00018Z"
									      fill="#90959F"/>
									<path d="M11.2454 15.3842V16.6782C11.2454 17.0922 11.5814 17.4282 11.9954 17.4282C12.4094 17.4282 12.7454 17.0922 12.7454 16.6782V15.3842C12.7454 14.9702 12.4094 14.6342 11.9954 14.6342C11.5814 14.6342 11.2454 14.9702 11.2454 15.3842Z"
									      fill="#90959F"/>
									<path fill-rule="evenodd" clip-rule="evenodd"
									      d="M10.2113 14.5564C10.1113 14.9194 9.7623 15.1514 9.38431 15.1014C6.8333 14.7454 4.39531 13.8404 2.33731 12.4814C2.12631 12.3434 2.00031 12.1074 2.00031 11.8554V8.3894C2.00031 6.2894 3.71231 4.5814 5.81731 4.5814H7.78431C7.97231 3.1294 9.20231 2.0004 10.7043 2.0004H13.2863C14.7873 2.0004 16.0183 3.1294 16.2063 4.5814H18.1833C20.2823 4.5814 21.9903 6.2894 21.9903 8.3894V11.8554C21.9903 12.1074 21.8633 12.3424 21.6543 12.4814C19.5923 13.8464 17.1443 14.7554 14.5763 15.1104C14.5413 15.1154 14.5073 15.1174 14.4733 15.1174C14.1343 15.1174 13.8313 14.8884 13.7463 14.5524C13.5443 13.7564 12.8213 13.1994 11.9903 13.1994C11.1483 13.1994 10.4333 13.7444 10.2113 14.5564ZM13.2863 3.5004H10.7043C10.0313 3.5004 9.46931 3.9604 9.30131 4.5814H14.6883C14.5203 3.9604 13.9583 3.5004 13.2863 3.5004Z"
									      fill="#90959F"/>
								</g>
							</svg>
						</div>
						<span class="nav-text">Produk</span>
					</a>
					<ul aria-expanded="false">
						@can(PermissionEnum::ADMIN_PRODUCTS_INDEX())
							<li>
								<a href="{{ route("admin.products.index") }}"
								   class="{{ request()->is(route("admin.products.index")) ? 'active' : '' }}">Product
								</a>
							</li>
						@endcan
						@can(PermissionEnum::ADMIN_PRODUCTS_LOW_QUANTITY())
							<li>
								<a href="{{ route("admin.products.low.quantity") }}"
								   class="{{ request()->is(route("admin.products.low.quantity")) ? 'active' : '' }}">Low
									Quantity Product
								</a>
							</li>
						@endcan
					</ul>
				</li>
			@endcanany

			@canany([PermissionEnum::ADMIN_ORDERS_INDEX(), PermissionEnum::ADMIN_ORDER_TRANSACTIONS(),PermissionEnum::ADMIN_EXPENSES_CREATE()])
				{{-- TRANSAKSI --}}
				<li>
					<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<g opacity="0.5">
									<path opacity="0.4"
									      d="M2.00018 11.0785C2.05018 13.4165 2.19018 17.4155 2.21018 17.8565C2.28118 18.7995 2.64218 19.7525 3.20418 20.4245C3.98618 21.3675 4.94918 21.7885 6.29218 21.7885C8.14818 21.7985 10.1942 21.7985 12.1812 21.7985C14.1762 21.7985 16.1122 21.7985 17.7472 21.7885C19.0712 21.7885 20.0642 21.3565 20.8362 20.4245C21.3982 19.7525 21.7592 18.7895 21.8102 17.8565C21.8302 17.4855 21.9302 13.1445 21.9902 11.0785H2.00018Z"
									      fill="#90959F"/>
									<path d="M11.2454 15.3842V16.6782C11.2454 17.0922 11.5814 17.4282 11.9954 17.4282C12.4094 17.4282 12.7454 17.0922 12.7454 16.6782V15.3842C12.7454 14.9702 12.4094 14.6342 11.9954 14.6342C11.5814 14.6342 11.2454 14.9702 11.2454 15.3842Z"
									      fill="#90959F"/>
									<path fill-rule="evenodd" clip-rule="evenodd"
									      d="M10.2113 14.5564C10.1113 14.9194 9.7623 15.1514 9.38431 15.1014C6.8333 14.7454 4.39531 13.8404 2.33731 12.4814C2.12631 12.3434 2.00031 12.1074 2.00031 11.8554V8.3894C2.00031 6.2894 3.71231 4.5814 5.81731 4.5814H7.78431C7.97231 3.1294 9.20231 2.0004 10.7043 2.0004H13.2863C14.7873 2.0004 16.0183 3.1294 16.2063 4.5814H18.1833C20.2823 4.5814 21.9903 6.2894 21.9903 8.3894V11.8554C21.9903 12.1074 21.8633 12.3424 21.6543 12.4814C19.5923 13.8464 17.1443 14.7554 14.5763 15.1104C14.5413 15.1154 14.5073 15.1174 14.4733 15.1174C14.1343 15.1174 13.8313 14.8884 13.7463 14.5524C13.5443 13.7564 12.8213 13.1994 11.9903 13.1994C11.1483 13.1994 10.4333 13.7444 10.2113 14.5564ZM13.2863 3.5004H10.7043C10.0313 3.5004 9.46931 3.9604 9.30131 4.5814H14.6883C14.5203 3.9604 13.9583 3.5004 13.2863 3.5004Z"
									      fill="#90959F"/>
								</g>
							</svg>
						</div>
						<span class="nav-text">Transaksi</span>
					</a>
					<ul aria-expanded="false">
						@can(PermissionEnum::ADMIN_ORDERS_INDEX())
							<li><a href="{{ route('admin.orders.index') }}"
							       class="{{ request()->is(route("admin.orders.index")) ? 'active' : '' }}">Order</a>
							</li>
						@endcan

						@can(PermissionEnum::ADMIN_ORDER_TRANSACTIONS())
							<li><a href="{{ route('admin.orders.transactions', ['type' => 'in']) }}"
							       class="{{ request()->is(route("admin.orders.transactions",['type' => 'in'])) ? 'active' : '' }}">Transaksi
									Produk Masuk</a></li>
							<li><a href="{{ route('admin.orders.transactions', ['type' => 'out']) }}"
							       class="{{ request()->is(route("admin.orders.transactions",['type' => 'out'])) ? 'active' : '' }}">Transaksi
									Produk Keluar</a></li>
							<li><a href="{{ route('admin.orders.transactions', ['type' => 'decline']) }}"
							       class="{{ request()->is(route("admin.orders.transactions",['type' => 'decline'])) ? 'active' : '' }}">Transaksi
									Produk Ditolak</a></li>
						@endcan

						@can(PermissionEnum::ADMIN_EXPENSES_CREATE())
							<li><a href="{{ route('admin.expenses.create') }}"
							       class="{{ request()->is(route('admin.expenses.create')) ? 'active' : '' }}">Pengeluaran/Pemasukan</a>
							</li>
						@endcan
					</ul>
				</li>
			@endcanany


			<li>
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
					<div class="menu-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
						     xmlns="http://www.w3.org/2000/svg">
							<g opacity="0.5">
								<path opacity="0.4"
								      d="M2.00018 11.0785C2.05018 13.4165 2.19018 17.4155 2.21018 17.8565C2.28118 18.7995 2.64218 19.7525 3.20418 20.4245C3.98618 21.3675 4.94918 21.7885 6.29218 21.7885C8.14818 21.7985 10.1942 21.7985 12.1812 21.7985C14.1762 21.7985 16.1122 21.7985 17.7472 21.7885C19.0712 21.7885 20.0642 21.3565 20.8362 20.4245C21.3982 19.7525 21.7592 18.7895 21.8102 17.8565C21.8302 17.4855 21.9302 13.1445 21.9902 11.0785H2.00018Z"
								      fill="#90959F"/>
								<path d="M11.2454 15.3842V16.6782C11.2454 17.0922 11.5814 17.4282 11.9954 17.4282C12.4094 17.4282 12.7454 17.0922 12.7454 16.6782V15.3842C12.7454 14.9702 12.4094 14.6342 11.9954 14.6342C11.5814 14.6342 11.2454 14.9702 11.2454 15.3842Z"
								      fill="#90959F"/>
								<path fill-rule="evenodd" clip-rule="evenodd"
								      d="M10.2113 14.5564C10.1113 14.9194 9.7623 15.1514 9.38431 15.1014C6.8333 14.7454 4.39531 13.8404 2.33731 12.4814C2.12631 12.3434 2.00031 12.1074 2.00031 11.8554V8.3894C2.00031 6.2894 3.71231 4.5814 5.81731 4.5814H7.78431C7.97231 3.1294 9.20231 2.0004 10.7043 2.0004H13.2863C14.7873 2.0004 16.0183 3.1294 16.2063 4.5814H18.1833C20.2823 4.5814 21.9903 6.2894 21.9903 8.3894V11.8554C21.9903 12.1074 21.8633 12.3424 21.6543 12.4814C19.5923 13.8464 17.1443 14.7554 14.5763 15.1104C14.5413 15.1154 14.5073 15.1174 14.4733 15.1174C14.1343 15.1174 13.8313 14.8884 13.7463 14.5524C13.5443 13.7564 12.8213 13.1994 11.9903 13.1994C11.1483 13.1994 10.4333 13.7444 10.2113 14.5564ZM13.2863 3.5004H10.7043C10.0313 3.5004 9.46931 3.9604 9.30131 4.5814H14.6883C14.5203 3.9604 13.9583 3.5004 13.2863 3.5004Z"
								      fill="#90959F"/>
							</g>
						</svg>
					</div>
					<span class="nav-text">Keuangan</span>
				</a>
				<ul aria-expanded="false">
					@can(PermissionEnum::ADMIN_FINANCE_TRANSACTIONS_INDEX())
						<li><a href="{{ route('admin.finance.transactions.index', ["type" => "all"]) }}"
						       class="{{ request()->is(route('admin.finance.transactions.index', ["type" => "all"])) ? 'active' : '' }}">Transaksi
								Keuangan</a></li>
						<li><a href="{{ route('admin.finance.transactions.index', ["type" => "debit"]) }}"
						       class="{{ request()->is(route('admin.finance.transactions.index', ["type" => "debit"])) ? 'active' : '' }}">Transaksi
								Pemasukan</a></li>
						<li><a href="{{ route('admin.finance.transactions.index', ["type" => "credit"]) }}"
						       class="{{ request()->is(route('admin.finance.transactions.index', ["type" => "credit"])) ? 'active' : '' }}">Transaksi
								Pengeluaran</a></li>
					@endcan
				</ul>
			</li>


			{{--PERMINTAAN PRODUKSI--}}
			@can(PermissionEnum::ADMIN_REQUEST_PRODUCTIONS_INDEX())
				<li>
					<a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
							     xmlns="http://www.w3.org/2000/svg">
								<g opacity="0.5">
									<path opacity="0.4"
									      d="M2.00018 11.0785C2.05018 13.4165 2.19018 17.4155 2.21018 17.8565C2.28118 18.7995 2.64218 19.7525 3.20418 20.4245C3.98618 21.3675 4.94918 21.7885 6.29218 21.7885C8.14818 21.7985 10.1942 21.7985 12.1812 21.7985C14.1762 21.7985 16.1122 21.7985 17.7472 21.7885C19.0712 21.7885 20.0642 21.3565 20.8362 20.4245C21.3982 19.7525 21.7592 18.7895 21.8102 17.8565C21.8302 17.4855 21.9302 13.1445 21.9902 11.0785H2.00018Z"
									      fill="#90959F"/>
									<path d="M11.2454 15.3842V16.6782C11.2454 17.0922 11.5814 17.4282 11.9954 17.4282C12.4094 17.4282 12.7454 17.0922 12.7454 16.6782V15.3842C12.7454 14.9702 12.4094 14.6342 11.9954 14.6342C11.5814 14.6342 11.2454 14.9702 11.2454 15.3842Z"
									      fill="#90959F"/>
									<path fill-rule="evenodd" clip-rule="evenodd"
									      d="M10.2113 14.5564C10.1113 14.9194 9.7623 15.1514 9.38431 15.1014C6.8333 14.7454 4.39531 13.8404 2.33731 12.4814C2.12631 12.3434 2.00031 12.1074 2.00031 11.8554V8.3894C2.00031 6.2894 3.71231 4.5814 5.81731 4.5814H7.78431C7.97231 3.1294 9.20231 2.0004 10.7043 2.0004H13.2863C14.7873 2.0004 16.0183 3.1294 16.2063 4.5814H18.1833C20.2823 4.5814 21.9903 6.2894 21.9903 8.3894V11.8554C21.9903 12.1074 21.8633 12.3424 21.6543 12.4814C19.5923 13.8464 17.1443 14.7554 14.5763 15.1104C14.5413 15.1154 14.5073 15.1174 14.4733 15.1174C14.1343 15.1174 13.8313 14.8884 13.7463 14.5524C13.5443 13.7564 12.8213 13.1994 11.9903 13.1994C11.1483 13.1994 10.4333 13.7444 10.2113 14.5564ZM13.2863 3.5004H10.7043C10.0313 3.5004 9.46931 3.9604 9.30131 4.5814H14.6883C14.5203 3.9604 13.9583 3.5004 13.2863 3.5004Z"
									      fill="#90959F"/>
								</g>
							</svg>
						</div>
						<span class="nav-text">Permintaan Produksi</span>
					</a>
					<ul aria-expanded="false">
						<li><a href="{{ route('admin.request.production.index', ["status" => "waiting"]) }}"
						       class="{{ request()->is(route("admin.request.production.index", ["status" => "waiting"])) ? 'active' : '' }}">Menunggu
								Produksi</a></li>
						<li><a href="{{ route('admin.request.production.index',["status" => "done"]) }}"
						       class="{{ request()->is(route("admin.request.production.index",["status" => "done"])) ? 'active' : '' }}">Sudah
								Diproduksi</a></li>
						<li><a href="{{ route('admin.request.production.index',["status" => "cancel"]) }}"
						       class="{{ request()->is(route("admin.request.production.index",["status" => "cancel"])) ? 'active' : '' }}">Batal
								Produksi</a></li>
					</ul>
				</li>
			@endcan

		</ul>
		<div class="copyright">
			<p class="fs-14"><strong>Abon Alfitri</strong> © 2023 All Rights Reserved</p>
			<p class="fs-14">Made with <span class="heart"></span> by AbonAlfitri</p>
		</div>
	</div>
</div>

{{--{{dd(auth()->user()->hasRole("administrator"))}}--}}