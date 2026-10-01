<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mb-2">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            @if (checkRocketFlareUser() == 1 && checkRocketFlareUser() != 2)
                <input type="hidden" value="{{ checkRocketFlareUser() ?? '0' }}">
                <img src="{{ asset('public/admin/assets/img/rocketflare/light-logo.png') }}" class="img-fluid light-logo img-logo" alt="Rocket Flare" />
                <img src="{{ asset('public/admin/assets/img/rocketflare/light-logo.png') }}" class="img-fluid dark-logo img-logo" alt="Rocket Flare" />
            @else
                @if (isset(setting()->white_logo) && !empty(setting()->white_logo))
                    <img src="{{ asset('admin/assets/settings') }}/{{ setting()->white_logo }}" class="img-fluid dark-logo img-logo" alt="{{ setting()->white_name }}" />
                @else
                    <img src="{{ asset('admin/assets/logo/vertical-w-logo.png') }}" class="img-fluid light-logo img-logo" alt="Client Onboarding" />
                    <img src="{{ asset('admin/assets/logo/vertical-b-logo.png') }}" class="img-fluid dark-logo img-logo" alt="Client Onboarding" />
                @endif
            @endif
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 my-1">
        <li class="menu-item {{ Route::is('admin.dashboard*') ? 'active' : ''}}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('admin.profile*') ? 'active' : ''}}">
            <a href="{{ route('admin.profile.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="Profile">My Profile</div>
            </a>
        </li>

        @canany(['settings-list', 'roles-list', 'permissions-list'])
        <li class="menu-item {{ Route::is('admin.settings*') || Route::is('admin.roles*') || Route::is('admin.permissions*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Administration">Administration</div>
            </a>
            <ul class="menu-sub">
                @can('settings-list')
                <li class="menu-item {{ Route::is('admin.settings*') ? 'active' : ''}}">
                    <a href="{{ route('admin.settings.index') }}" class="menu-link">
                        <div data-i18n="Settings">Settings</div>
                    </a>
                </li>
                @endcan
                @can('roles-list')
                <li class="menu-item {{ Route::is('admin.roles*') ? 'active' : ''}}">
                    <a href="{{ route('admin.roles.index') }}" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                @endcan
                @can('permissions-list')
                <li class="menu-item {{ Route::is('admin.permissions*') ? 'active' : ''}}">
                    <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                        <div data-i18n="Permissions">Permissions</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['projects-list', 'projects-create', 'projects-edit', 'projects-delete'])
        <li class="menu-item {{ Route::is('admin.projects*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-folder"></i>
                <div data-i18n="Projects">Projects</div>
            </a>
            <ul class="menu-sub">
                @can('projects-list')
                <li class="menu-item {{ Route::is('admin.projects.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.projects.index') }}" class="menu-link">
                        <div data-i18n="All Projects">All Projects</div>
                    </a>
                </li>
                @endcan
                @can('projects-create')
                <li class="menu-item {{ Route::is('admin.projects.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.projects.create') }}" class="menu-link">
                        <div data-i18n="Add Project">Add Project</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['experiences-list', 'experiences-create', 'experiences-edit', 'experiences-delete'])
        <li class="menu-item {{ Route::is('admin.experiences*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div data-i18n="Experiences">Experiences</div>
            </a>
            <ul class="menu-sub">
                @can('experiences-list')
                <li class="menu-item {{ Route::is('admin.experiences.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.experiences.index') }}" class="menu-link">
                        <div data-i18n="All Experiences">All Experiences</div>
                    </a>
                </li>
                @endcan
                @can('experiences-create')
                <li class="menu-item {{ Route::is('admin.experiences.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.experiences.create') }}" class="menu-link">
                        <div data-i18n="Add Experience">Add Experience</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['educations-list', 'educations-create', 'educations-edit', 'educations-delete'])
        <li class="menu-item {{ Route::is('admin.education*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-school"></i>
                <div data-i18n="Education">Education</div>
            </a>
            <ul class="menu-sub">
                @can('educations-list')
                <li class="menu-item {{ Route::is('admin.education.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.education.index') }}" class="menu-link">
                        <div data-i18n="All Education">All Education</div>
                    </a>
                </li>
                @endcan
                @can('educations-create')
                <li class="menu-item {{ Route::is('admin.education.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.education.create') }}" class="menu-link">
                        <div data-i18n="Add Education">Add Education</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['skills-list', 'skills-create', 'skills-edit', 'skills-delete'])
        <li class="menu-item {{ Route::is('admin.skills*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-cpu"></i>
                <div data-i18n="Skills">Skills</div>
            </a>
            <ul class="menu-sub">
                @can('skills-list')
                <li class="menu-item {{ Route::is('admin.skills.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.skills.index') }}" class="menu-link">
                        <div data-i18n="All Skills">All Skills</div>
                    </a>
                </li>
                @endcan
                @can('skills-create')
                <li class="menu-item {{ Route::is('admin.skills.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.skills.create') }}" class="menu-link">
                        <div data-i18n="Add Skill">Add Skill</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['services-list', 'services-create', 'services-edit', 'services-delete'])
        <li class="menu-item {{ Route::is('admin.services*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-tool"></i>
                <div data-i18n="Services">Services</div>
            </a>
            <ul class="menu-sub">
                @can('services-list')
                <li class="menu-item {{ Route::is('admin.services.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.services.index') }}" class="menu-link">
                        <div data-i18n="All Services">All Services</div>
                    </a>
                </li>
                @endcan
                @can('services-create')
                <li class="menu-item {{ Route::is('admin.services.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.services.create') }}" class="menu-link">
                        <div data-i18n="Add Service">Add Service</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['testimonials-list', 'testimonials-create', 'testimonials-edit', 'testimonials-delete'])
        <li class="menu-item {{ Route::is('admin.testimonials*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-quote"></i>
                <div data-i18n="Testimonials">Testimonials</div>
            </a>
            <ul class="menu-sub">
                @can('testimonials-list')
                <li class="menu-item {{ Route::is('admin.testimonials.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
                        <div data-i18n="All Testimonials">All Testimonials</div>
                    </a>
                </li>
                @endcan
                @can('testimonials-create')
                <li class="menu-item {{ Route::is('admin.testimonials.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.testimonials.create') }}" class="menu-link">
                        <div data-i18n="Add Testimonial">Add Testimonial</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['contact_messages-list', 'contact_messages-show', 'contact_messages-delete'])
        <li class="menu-item {{ Route::is('admin.messages*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div data-i18n="Messages">Messages</div>
            </a>
            <ul class="menu-sub">
                @can('contact_messages-list')
                <li class="menu-item {{ Route::is('admin.messages.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.messages.index') }}" class="menu-link">
                        <div data-i18n="All Messages">All Messages</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['users-list', 'users-create', 'users-edit', 'users-delete'])
        <li class="menu-item {{ Route::is('admin.users*') ? 'active open' : ''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                @can('users-list')
                <li class="menu-item {{ Route::is('admin.users.index') ? 'active' : ''}}">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div data-i18n="All Users">All Users</div>
                    </a>
                </li>
                @endcan
                @can('users-create')
                <li class="menu-item {{ Route::is('admin.users.create') ? 'active' : ''}}">
                    <a href="{{ route('admin.users.create') }}" class="menu-link">
                        <div data-i18n="Add User">Add User</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
    </ul>
</aside>
