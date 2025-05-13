<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
	<link rel="icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-32x32.png') }}" sizes="32x32" />
	<link rel="icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-192x192.png') }}" sizes="192x192" />
	<link rel="apple-touch-icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-180x180.png') }}" />
</head>

<body>
	<div class="main-wrapper">

		<!-- partial:../../partials/_sidebar.html -->
		<nav class="sidebar">
			<div class="sidebar-header">
				<a href="{{ route('home') }}" class="sidebar-brand">
					Admin<span>CP</span>
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
					<li class="nav-item">
						<a href="{{ route('home') }}" class="nav-link">
						  <i class="link-icon" data-feather="box"></i>
						  <span class="link-title">Dashboard</span>
						</a>
					</li>
					@admin
						<li class="nav-item nav-category">Admin</li>
						<li class="nav-item @isLinkActive('admin.users.*') active @endisLinkActive">
							<a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}" aria-controls="users">
								<i class="link-icon" data-feather="users"></i>
								<span class="link-title">Users</span>
								<i class="link-arrow" data-feather="chevron-down"></i>
							</a>
							<div class="collapse @isLinkActive('admin.users.*') show @endisLinkActive" id="users">
								<ul class="nav sub-menu">
									<li class="nav-item">
										<a href="{{ route('admin.users.index') }}" class="nav-link @isLinkActive('admin.users.index') active @endisLinkActive">All Users</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('admin.users.create') }}" class="nav-link @isLinkActive('admin.users.create') active @endisLinkActive">Add New User</a>
									</li>
								</ul>
							</div>
						</li>
					@endadmin
					<li class="nav-item nav-category">Courses</li>
					<li class="nav-item @isLinkActive('courses.*') active @endisLinkActive">
						<a class="nav-link" data-toggle="collapse" href="#courses" role="button" aria-expanded="{{ request()->routeIs('courses.*') ? 'true' : 'false' }}" aria-controls="courses">
							<i class="link-icon" data-feather="book"></i>
							<span class="link-title">Courses</span>
							<i class="link-arrow" data-feather="chevron-down"></i>
						</a>
						<div class="collapse @isLinkActive('courses.*') show @endisLinkActive" id="courses">
							<ul class="nav sub-menu">
								@foreach (\App\Enums\CourseLevel::cases() as $courseLevel)
									@php
										$courseLevelNum = explode('_', $courseLevel->value)[1];
									@endphp
									<li class="nav-item">
										<a href="{{ route('courses.showLevel', ['level' => $courseLevelNum]) }}" class="nav-link @isLinkActive('courses.index', ['level' => $courseLevelNum]) active @endisLinkActive">	
											{{ 'Level ' . $courseLevelNum }}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<!-- partial -->

		<div class="page-wrapper">

			<!-- partial:../../partials/_navbar.html -->
			<nav class="navbar">
				<a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
				<div class="navbar-content">
					<ul class="navbar-nav">
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
												<button type="submit" class="nav-link">
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
				<p class="text-muted text-center text-md-left">Copyright © 2020. All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i
						class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->

		</div>
	</div>
	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
</body>

</html>