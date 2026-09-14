<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                        <path d="M13.7918663,0.358365126 L13.7918663,0.358365126" id="path-3"></path>
                        <path d="M13.7918663,0.358365126 L13.7918663,0.358365126" id="path-4"></path>
                        <path d="M13.7918663,0.358365126 L13.7918663,0.358365126" id="path-5"></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <path class="text-primary" d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                                <path class="text-primary" opacity="0.6" d="M13.7918663,0.358365126 L13.7918663,0.358365126" id="path-3"></path>
                                <path class="text-primary" opacity="0.6" d="M13.7918663,0.358365126 L13.7918663,0.358365126" id="path-4"></path>
                                <path class="text-primary" opacity="0.6" d="M13.7918663,0.358365126 L13.7918663,0.358365126" id="path-5"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Content Management</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.projects.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.projects.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Projects">Projects</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.experiences.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.experiences.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase-alt"></i>
                <div data-i18n="Experiences">Experiences</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.education.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.education.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-graduation"></i>
                <div data-i18n="Education">Education</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.skills.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.skills.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-award"></i>
                <div data-i18n="Skills">Skills</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.services.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.services.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div data-i18n="Services">Services</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.testimonials.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-square-detail"></i>
                <div data-i18n="Testimonials">Testimonials</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Communication</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.messages.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.messages.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Messages">Messages
                    @if (\App\Models\ContactMessage::unread()->count() > 0)
                        <span class="badge bg-label-primary rounded-pill ms-auto">{{ \App\Models\ContactMessage::unread()->count() }}</span>
                    @endif
                </div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Administration</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
    </ul>
</aside>
<div class="layout-menu-toggle navbar-fixed d-xl-none"><i class="bx bx-chevron-left"></i></div>