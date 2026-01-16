<aside id="leftsidebar" class="sidebar">
	<div class="navbar-brand">
		<button class="btn-menu ls-toggle-btn" type="button">
			<i class="zmdi zmdi-menu"></i>
		</button>
		<a href="/" target="_blank"><img src="/uploads/Setting/logo_footer.png" width="25" alt="Smart" /><span class="m-l-10">ITDB</span></a>
	</div>
	<div class="menu">
		<ul class="list">
			<li>
				<div class="user-info">
					<a class="image" href="{{ route('admin.profile') }}"><img src="/Smart/Admin/assets/images/avatar.jpg" alt="User" /></a>
					<div class="detail">
						<h4>{{ Auth::user()->name }}</h4>
						<small>{{ Auth::user()->role }}</small>
					</div>
				</div>
			</li>
			<li class="{{ 'admin/dashboard' ==request()->path() ? 'active':'' }} open">
				<a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
			</li>
			<li class="{{ Request::is('admin/sectors*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>Sectors</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.departments') }}">All Sectors</a></li>
					<li><a href="{{ route('admin.department.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/directorates*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-filter-list"></i><span>Directorates</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.directorates') }}">All Directorates</a></li>
					<li><a href="{{ route('admin.directorate.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/services*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-view-list-alt"></i><span>Services</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.services') }}">All Services</a></li>
					<li><a href="{{ route('admin.service.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/blogcategories*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>Blog Categories</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.blogcategories') }}">All Categories</a></li>
					<li><a href="{{ route('admin.blogcategory.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/blogs*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>Blogs</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.blogs') }}">All Blogs</a></li>
					<li><a href="{{ route('admin.blog.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/eventcategories*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-speaker"></i><span>Event Categories</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.eventcategories') }}">All Categories</a></li>
					<li><a href="{{ route('admin.eventcategory.create') }}">Add New</a></li>
				</ul>
			</li>
			
			<li class="{{ Request::is('admin/events*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-tv-list"></i><span>Events</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.events') }}">All Events</a></li>
					<li><a href="{{ route('admin.event.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/galleries*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-camera-alt"></i><span>Galleries</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.galleries') }}">All Galleries</a></li>
					<li><a href="{{ route('admin.gallery.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/publicationcategories*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-file"></i><span>Publication Cat</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.publicationcategories') }}">All Categories</a></li>
					<li><a href="{{ route('admin.publicationcategory.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/publications*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-collection-pdf"></i><span>Publications</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.publications') }}">All Publications</a></li>
					<li><a href="{{ route('admin.publication.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/histories*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-replay-5"></i><span>History</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.histories') }}">All Histories</a></li>
					<li><a href="{{ route('admin.history.create') }}">Add New</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/vacancies*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-space-bar"></i><span>Vacancies</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.vacancies') }}">All Vacancies</a></li>
					<li><a href="{{ route('admin.vacancy.create') }}">Add New</a></li>
				</ul>
			</li>
			
			<li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
				<a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings"></i><span>CMS</span></a>
				<ul class="ml-menu">
					<li><a href="{{ route('admin.site.settings') }}">Site Settings</a></li>
					<li><a href="{{ route('admin.users') }}">User Management</a></li>
					<li><a href="{{ route('admin.testimonies') }}">Testimonials</a></li>
					<li><a href="{{ route('admin.banners') }}">Banner</a></li>
					<li><a href="{{ route('admin.teams') }}">Teams</a></li>
					<li><a href="{{ route('admin.partners') }}">Stake Holders</a></li>
					<li><a href="{{ route('admin.faqs') }}">Help Center</a></li>
					<li><a href="{{ route('admin.logs') }}">System Logs</a></li>
					<li><a href="{{ route('admin.profile') }}">Manage Profile</a></li>
					<li><a href="{{ route('password') }}">Change Password</a></li>
				</ul>
			</li>
			<li class="{{ Request::is('admin/contacts*') ? 'active' : '' }}">
				<a href="{{ route('admin.contacts') }}"><i class="zmdi zmdi-account-box-phone"></i><span>Messages</span></a>
			</li>
		</ul>
	</div>
</aside>