<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button">
            <i class="zmdi zmdi-menu"></i>
        </button>
        <a href="/" target="_blank"><span class="m-l-10"> LDAB</span></a>
    </div>

    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
<a class="image" href="{{ route('admin.profile') }}">
    <img src="/Smart/Admin/assets/images/avatar.jpg" alt="User" />
</a>

                    <div class="detail">
                        <h4>{{ Auth::user()->name }}</h4>
                        <small>{{ Auth::user()->getRoleNames()->first() ?? 'N/A' }}</small>
                    </div>
                </div>
            </li>

            {{-- Dashboard --}}
            <li class="{{ 'admin/dashboard' == request()->path() ? 'active' : '' }} open">
                <a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            </li>

           {{-- Doctors --}}
@can('doctor_access')
<li class="{{ Request::is('admin/doctors*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>Doctors</span></a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.doctors.index') }}">All Doctors</a></li>
        @can('doctor_create')
        <li><a href="{{ route('admin.doctors.create') }}">Add New</a></li>
        @endcan
    </ul>
</li>
@endcan

            {{-- Services --}}
            @can('service_access')
            <li class="{{ Request::is('admin/services*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-view-list-alt"></i><span>Services</span></a>
                <ul class="ml-menu">
                    <li><a href="{{ route('admin.services.index') }}">All Services</a></li>
                    @can('service_create')
                    <li><a href="{{ route('admin.services.create') }}">Add New</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

          {{-- About Menu --}}
@can('about_access') {{-- default 'web' guard --}}
<li class="{{ Request::is('admin/about*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-info-outline"></i><span>About</span></a>
    <ul class="ml-menu">
        @can('about_access')
        <li><a href="{{ route('admin.about.index') }}"> About Page</a></li>
        @endcan
        @can('about_create')
        <li><a href="{{ route('admin.about.create') }}">Add New</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- Departments --}}
@can('department_access')
<li class="{{ Request::is('admin/departments*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-hospital"></i>
        <span>Departments</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.departments.index') }}">All Departments</a></li>
        @can('department_create')
        <li><a href="{{ route('admin.departments.create') }}">Add New</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- News --}}
@can('news_access')
<li class="{{ Request::is('admin/news*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-file-text"></i>
        <span>News</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.news.index') }}">All News</a></li>
        @can('news_create')
        <li><a href="{{ route('admin.news.create') }}">Add New</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- Health Information --}}
@can('health_info_access')
<li class="{{ Request::is('admin/health-info*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-file-text"></i><span>Health Information</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.health-info.index') }}">All Resources</a></li>
        @can('health_info_create')
        <li><a href="{{ route('admin.health-info.create') }}">Add New Resource</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- Health Info Categories --}}
@can('health_info_category_access')
<li class="{{ Request::is('admin/health_info_category*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-folder"></i><span>Health Info Categories</span></a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.health_info_category.index') }}">All Categories</a></li>
        @can('health_info_category_create')
        <li><a href="{{ route('admin.health_info_category.create') }}">Add New</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- Facilities --}}
@can('facility_access')
<li class="{{ Request::is('admin/facilities*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-hospital"></i>
        <span>Facilities</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.facilities.index') }}">All Facilities</a></li>
        @can('facility_create')
        <li><a href="{{ route('admin.facilities.create') }}">Add Facility</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- Featured Services --}}
@can('feature_access')
<li class="{{ Request::is('admin/features*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-star"></i>
        <span>Features</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.features.index') }}">All Features</a></li>
        @can('feature_create')
        <li><a href="{{ route('admin.features.create') }}">Add Features</a></li>
        @endcan
    </ul>
</li>
@endcan

@can('banners_access')
<li class="{{ Request::is('admin/banners*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-image"></i>
        <span>Banners</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.banners.index') }}">All Banners</a></li>
        @can('banners_create')
        <li><a href="{{ route('admin.banners.create') }}">Add Banner</a></li>
        @endcan
    </ul>
</li>
@endcan

@can('partnerships_access')
<li class="{{ Request::is('admin/partnerships*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-accounts"></i>
        <span>Partners</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.partnerships.index') }}">All Partners</a></li>
        @can('partnerships_create')
        <li><a href="{{ route('admin.partnerships.create') }}">Add Partner</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- Accreditations --}}
@can('accreditation_access')
<li class="{{ Request::is('admin/accreditations*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-card-membership"></i><span>Accreditations</span></a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.accreditations.index') }}">All Accreditations</a></li>
        @can('accreditation_create')
        <li><a href="{{ route('admin.accreditations.create') }}">Add New</a></li>
        @endcan
    </ul>
</li>
@endcan

            {{-- Galleries --}}
            @can('gallery_access')
            <li class="{{ Request::is('admin/galleries*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-camera-alt"></i><span>Galleries</span></a>
                <ul class="ml-menu">
                    <li><a href="{{ route('admin.galleries.index') }}">All Galleries</a></li>
                    @can('gallery_create')
                    <li><a href="{{ route('admin.galleries.create') }}">Add New</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Comments --}}
@can('comment_access')
<li class="{{ Request::is('admin/comments*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-comment-text"></i>
        <span>Comments</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.comments.index') }}">All Comments</a></li>
        @can('comment_create')
        <li><a href="{{ route('admin.comments.create') }}">Add Comment</a></li>
        @endcan
    </ul>
</li>
@endcan

{{-- CMS / Settings --}}
@can('setting_access')
<li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-settings"></i>
        <span>CMS</span>
    </a>
    <ul class="ml-menu">
        {{-- Site Settings Parent --}}
        <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-toggle">Site Settings</a>
            <ul class="ml-menu">
                <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.site.settings') }}">General Settings</a>
                </li>
                <li class="{{ Request::is('admin/settings/visibility') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.visibility') }}">Visibilities</a>
                </li>
            </ul>
        </li>

        {{-- User Management --}}
        @can('user_access')
        <li><a href="{{ route('admin.users.index') }}">User Management</a></li>
        @endcan

        {{-- Role Management --}}
        @can('role_access')
        <li><a href="{{ route('admin.roles.index') }}">Role Management</a></li>
        @endcan

        {{-- Testimonials --}}
        @can('testimony_access')
        <li><a href="{{ route('admin.testimonies.index') }}">Testimonials</a></li>
        @endcan

        {{-- Banner --}}
        @can('banner_access')
        <li><a href="{{ route('admin.banners.index') }}">Banner</a></li>
        @endcan

        {{-- Stake Holders --}}
        @can('partner_access')
        <li><a href="{{ route('admin.partners.index') }}">Stake Holders</a></li>
        @endcan

        {{-- Help Center --}}
        @can('faq_access')
        <li><a href="{{ route('admin.faqs.index') }}">Help Center</a></li>
        @endcan

        {{-- System Logs --}}
        @can('log_access')
        <li><a href="{{ route('admin.logs.index') }}">System Logs</a></li>
        @endcan

{{-- Profile & Password --}}
<li><a href="{{ route('admin.profile') }}">Manage Profile</a></li>
<li><a href="{{ route('admin.settings.password') }}">Change Password</a></li>

    </ul>
</li>
@endcan

            <li class="{{ request()->is('admin/appointments*') ? 'active' : '' }}">
    <a href="{{ route('admin.appointments.index') }}">
        <i class="zmdi zmdi-calendar-note"></i>
        <span>Appointments</span>
    </a>
</li>

            <li class="{{ request()->is('admin/messages*') ? 'active' : '' }}">
    <a href="{{ route('admin.contacts') }}">
        <i class="zmdi zmdi-email"></i>
        <span>Messages</span>
    </a>
</li>

<li class="{{ request()->is('admin/complaints*') ? 'active' : '' }}">
    <a href="{{ route('admin.complaints.index') }}">
        <i class="zmdi zmdi-alert-triangle"></i>
        <span>Complaints</span>
    </a>
</li>
        </ul>
    </div>
</aside>
