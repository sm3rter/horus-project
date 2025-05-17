<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Control System</title>
	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
	<link rel="icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-32x32.png') }}" sizes="32x32" />
	<link rel="icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-192x192.png') }}" sizes="192x192" />
	<link rel="apple-touch-icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-180x180.png') }}" />
	@yield('styles')
</head>

<body class="sidebar-dark">
	<div class="main-wrapper">

		<!-- partial:../../partials/_sidebar.html -->
		<nav class="sidebar">
			<div class="sidebar-header">
				<a href="{{ route('home') }}" class="sidebar-brand">
					{{-- HUE<span><small> Control Sys.</small></span> --}}
					<div class="d-flex justify-content-between">
						<img src="{{ asset('assets/images/mecha-logo.png') }}" alt="logo" width="55">
						<img src="{{ asset('assets/images/faculty-logo.png') }}" alt="logo" width="55">
					</div>
				</a>
				<div class="sidebar-toggler not-active">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			<div class="sidebar-body">
				<ul class="nav">
					<li class="nav-item nav-category">Main</li>
					<li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
						<a href="{{ route('home') }}" class="nav-link">
							<i class="link-icon" data-feather="box"></i>
							<span class="link-title">Reports</span>
						</a>
					</li>
					@admin
					<li class="nav-item nav-category">Admin</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false"
							aria-controls="users">
							<i class="link-icon" data-feather="users"></i>
							<span class="link-title">Users</span>
							<i class="link-arrow" data-feather="chevron-down"></i>
						</a>
						<div class="collapse {{ request()->routeIs('admin.users.index', 'admin.users.create') ? 'show' : '' }}" id="users">
							<ul class="nav sub-menu">
								<li class="nav-item">
									<a href="{{ route('admin.users.index') }}" class="nav-link">All Users</a>
								</li>
								<li class="nav-item">
									<a href="{{ route('admin.users.create') }}" class="nav-link">Add New User</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item nav-category">Courses</li>
					<li class="nav-item {{ request()->routeIs('courses.create') ? 'active' : '' }}">
						<a href="{{ route('courses.create') }}" class="nav-link">
							<i class="link-icon" data-feather="plus"></i>
							<span class="link-title">Add New Course</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#courses" role="button" aria-expanded="false"
							aria-controls="courses">
							<i class="link-icon" data-feather="book"></i>
							<span class="link-title">Courses</span>
							<i class="link-arrow" data-feather="chevron-down"></i>
						</a>
						<div class="collapse {{ request()->routeIs('courses.showLevel') ? 'show' : '' }}" id="courses">
							<ul class="nav sub-menu">
								@for ($i = 0; $i < 5; $i++)
								<li class="nav-item">
									<a href="{{ route('levels.showLevel', ['level' => 'level_' . $i]) }}"
										class="nav-link">
										{{ 'Level ' . $i }}
									</a>
								</li>
								@endfor
							</ul>
						</div>
					</li>
					@endadmin
				</ul>
			</div>
		</nav>
		<!-- partial -->

		<div class="page-wrapper" style="background-color:#fdfdfd;">

			<!-- partial:../../partials/_navbar.html -->
			<nav class="navbar">
				<a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
				<div class="navbar-content">
					<ul class="navbar-nav">
						@if($nonReadCheckedReports->count() > 0)
						<li class="nav-item dropdown nav-notifications">
							<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="bell" class="text-danger"></i>
								<div class="indicator">
									<div class="circle"></div>
								</div>
							</a>
							<div class="dropdown-menu" aria-labelledby="notificationDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">{{  $nonReadCheckedReports->count() }} New Notifications</p>
								</div>
								<div class="dropdown-body">
									@foreach($nonReadCheckedReports->take(5) as $report)
									<a href="{{ route('home') }}" class="dropdown-item">
										<div class="icon">
											<i data-feather="alert-circle"></i>
										</div>
										<div class="content">
											<p>{{ $report->title }}</p>
											<p class="sub-text text-muted">{{ $report->created_at->diffForHumans() }}</p>
										</div>
									</a>
									@endforeach
								</div>
							</div>
						</li>
						@endif
						<li class="nav-item dropdown nav-profile">
							<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{ asset('assets/images/profile.png') }}" alt="profile">
							</a>
							<div class="dropdown-menu" aria-labelledby="profileDropdown">
								<div class="dropdown-header d-flex flex-column align-items-center">
									<div class="figure mb-3">
										<img src="{{ asset('assets/images/profile.png') }}" alt="">
									</div>
									<div class="info text-center">
										<p class="name font-weight-bold mb-0">{{ auth()->user()->name }}</p>
										<p class="email text-muted mb-3">{{ auth()->user()->email }}</p>
									</div>
								</div>
								<div class="dropdown-body">
									<ul class="profile-nav p-0 pt-3">
										<li class="nav-item">
											<a href="{{ route('profile.index') }}" class="nav-link">
												<i data-feather="edit"></i>
												<span>Edit Profile</span>
											</a>
										</li>
										<li class="nav-item">
											<form action="{{ route('authentication.logout') }}" method="POST">
												@csrf
												<button type="submit" class="btn btn-link nav-link">
													<i data-feather="log-out"></i>
													<span>Log Out</span>
												</button>
											</form>
										</li>
									</ul>
								</div>
							</div>
						</li>

					</ul>
				</div>
			</nav>
			<!-- partial -->

			<div class="page-content">
				@include('layouts.flash-alert')
				@yield('content')
			</div>

			<!-- partial:../../partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
				<p class="text-muted text-center text-md-left">supervised by <span class="text-primary">Assoc. Prof. Dr. Mohammed Kamal - Prof. Dr. Hatem Khater</span></p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Developed by 
					<span class="text-primary">
						<a href="https://wa.me/+201016773589" target="_blank">X Team</a>
					</span>
					<span>Level 4 - Mechatronics Engineering</span>
				</p>
			</footer>
			<!-- partial -->

		</div>
	</div>
	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
		const currentPath = window.location.href;
		const navLinks = document.querySelectorAll('.sidebar .nav-link');
		navLinks.forEach(link => {
			const href = link.getAttribute('href');
			if (href === currentPath) {
			link.classList.add('active');
			const parentItem = link.closest('.nav-item');
			if (parentItem) {
				parentItem.classList.add('active');
			}
			const subMenu = link.closest('.sub-menu');
			if (subMenu) {
				const collapseElement = subMenu.closest('.collapse');
				if (collapseElement) {
				collapseElement.classList.add('show');
				const collapseId = collapseElement.id;
				const toggle = document.querySelector(`[href="#${collapseId}"]`);
				if (toggle) {
					toggle.setAttribute('aria-expanded', 'true');
					const toggleParent = toggle.closest('.nav-item');
					if (toggleParent) {
					toggleParent.classList.add('active');
					}
				}
				}
			}
			}
		});
		const collapseTriggers = document.querySelectorAll('.sidebar [data-toggle="collapse"]');
		collapseTriggers.forEach(trigger => {
			trigger.addEventListener('click', function(e) {
			const targetId = this.getAttribute('href');
			if (!targetId || !targetId.startsWith('#')) return;
			const isExpanded = this.getAttribute('aria-expanded') === 'true';
			this.setAttribute('aria-expanded', !isExpanded);
			if (!isExpanded) {
				const parentItem = this.closest('.nav-item');
				if (parentItem) {
				parentItem.classList.add('active');
				}
			}
			});
		});
		});
	</script>
	@yield('scripts')
</body>

</html>