@extends('admin.layouts.app')

@section('title', 'Profile Settings')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/basic-dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-info-tab" data-bs-toggle="pill" data-bs-target="#profile-info" type="button" role="tab">
                        <i class="ti ti-user me-2"></i> Profile Info
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('admin.profile.messages') }}" role="tab">
                        <i class="ti ti-mail me-2"></i> Messages
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-links-tab" data-bs-toggle="pill" data-bs-target="#social-links" type="button" role="tab">
                        <i class="ti ti-share me-2"></i> Social Links
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="portfolio-tab" data-bs-toggle="pill" data-bs-target="#portfolio" type="button" role="tab">
                        <i class="ti ti-globe me-2"></i> Portfolio Settings
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="images-tab" data-bs-toggle="pill" data-bs-target="#images" type="button" role="tab">
                        <i class="ti ti-photo me-2"></i> Images & Branding
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab">
                        <i class="ti ti-lock me-2"></i> Password
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="profileTabsContent">
        <!-- Profile Info Tab -->
        <div class="tab-pane fade show active" id="profile-info" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Profile Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Professional Title</label>
                            <input type="text" class="form-control" name="professional_title" value="{{ $user->professional_title }}" placeholder="e.g. Full Stack Developer, Laravel Expert">
                            <small class="text-muted">Shown on your portfolio header</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Portfolio Slug</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ request()->getHttpHost() }}/</span>
                                <input type="text" class="form-control" name="portfolio_slug" value="{{ $user->portfolio_slug }}" placeholder="your-name">
                            </div>
                            <small class="text-muted">Your portfolio URL: <strong>{{ request()->getHttpHost() }}/{{ $user->portfolio_slug ?? 'your-slug' }}</strong></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="+92 300 1234567">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="{{ $user->location }}" placeholder="Karachi, Pakistan">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Website</label>
                            <input type="url" class="form-control" name="website" value="{{ $user->website }}" placeholder="https://yourwebsite.com">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Bio / About Me</label>
                            <textarea class="form-control" name="bio" rows="5" placeholder="Tell visitors about yourself...">{{ $user->bio }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Profile Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Social Links Tab -->
        <div class="tab-pane fade" id="social-links" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Social Media Links</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-linkedin text-primary me-2"></i> LinkedIn
                            </label>
                            <input type="url" class="form-control" name="linkedin" value="{{ $user->linkedin }}" placeholder="https://linkedin.com/in/yourname">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-github text-dark me-2"></i> GitHub
                            </label>
                            <input type="url" class="form-control" name="github" value="{{ $user->github }}" placeholder="https://github.com/yourname">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-twitter text-info me-2"></i> Twitter / X
                            </label>
                            <input type="url" class="form-control" name="twitter" value="{{ $user->twitter }}" placeholder="https://twitter.com/yourname">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-facebook text-primary me-2"></i> Facebook
                            </label>
                            <input type="url" class="form-control" name="facebook" value="{{ $user->facebook }}" placeholder="https://facebook.com/yourname">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-instagram text-danger me-2"></i> Instagram
                            </label>
                            <input type="url" class="form-control" name="instagram" value="{{ $user->instagram }}" placeholder="https://instagram.com/yourname">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-youtube text-danger me-2"></i> YouTube
                            </label>
                            <input type="url" class="form-control" name="youtube" value="{{ $user->youtube }}" placeholder="https://youtube.com/@yourname">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Social Links</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Portfolio Settings Tab -->
        <div class="tab-pane fade" id="portfolio" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Portfolio Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="col-12">
                            <div class="alert alert-info">
                                <h5><i class="ti ti-info-circle me-2"></i> Portfolio Preview</h5>
                                <p class="mb-0">Your public portfolio is accessible at:</p>
                                <div class="mt-2">
                                    <code class="d-block p-2 bg-light rounded">{{ request()->getHttpHost() }}/{{ $user->portfolio_slug ?? 'your-slug' }}</code>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Portfolio Slug <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">{{ request()->getHttpHost() }}/</span>
                                <input type="text" class="form-control" name="portfolio_slug" value="{{ $user->portfolio_slug }}" required pattern="[a-z0-9-]+" title="Only lowercase letters, numbers, and hyphens">
                            </div>
                            <small class="text-muted">Only lowercase letters, numbers, and hyphens allowed</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Professional Title</label>
                            <input type="text" class="form-control" name="professional_title" value="{{ $user->professional_title }}" placeholder="Senior Laravel Developer">
                            <small class="text-muted">Displayed prominently on your portfolio header</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Bio / About Me</label>
                            <textarea class="form-control" name="bio" rows="5" placeholder="Write a compelling bio for your portfolio...">{{ $user->bio }}</textarea>
                            <small class="text-muted">Shown in the about section of your portfolio</small>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Portfolio Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Images & Branding Tab -->
        <div class="tab-pane fade" id="images" role="tabpanel">
            <div class="row">
                <!-- Profile Image -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Image</h5>
                        </div>
                        <div class="card-body text-center">
                            @if ($user->profile_image)
                                <img src="{{ asset('storage/users/' . $user->profile_image) }}" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                            @else
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 150px; height: 150px;">
                                    <i class="ti ti-user text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <input type="hidden" name="name" value="{{ $user->name }}">
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    <input type="file" class="form-control mb-2" name="profile_image" accept="image/*">
                                    <small class="text-muted d-block mb-2">Recommended: 400x400px, JPG/PNG/WebP, Max 2MB</small>
                                    <button type="submit" class="btn btn-sm btn-primary">Upload Profile Image</button>
                                @if ($user->profile_image)
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteProfileImageModal">Remove</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Header/Banner -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Portfolio Header/Banner</h5>
                        </div>
                        <div class="card-body text-center">
                            @if ($user->portfolio_header)
                                <img src="{{ asset('storage/users/' . $user->portfolio_header) }}" alt="Portfolio Header" class="img-fluid rounded mb-3">
                            @else
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded d-inline-flex align-items-center justify-content-center mb-3">
                                    <i class="ti ti-photo text-white" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <input type="file" class="form-control mb-2" name="portfolio_header" accept="image/*">
                                <small class="text-muted d-block mb-2">Recommended: 1200x400px, JPG/PNG/WebP, Max 5MB</small>
                                <button type="submit" class="btn btn-sm btn-primary">Upload Header</button>
                                @if ($user->portfolio_header)
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteHeaderModal">Remove</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Logo -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Logo</h5>
                        </div>
                        <div class="card-body text-center">
                            @if ($user->logo)
                                <img src="{{ asset('storage/users/' . $user->logo) }}" alt="Logo" class="img-fluid rounded mb-3" style="max-width: 150px; height: auto;">
                            @else
                                <div class="bg-light rounded d-inline-flex align-items-center justify-content-center mb-3" style="width: 150px; height: 80px;">
                                    <i class="ti ti-brand-megaphone text-muted" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <input type="file" class="form-control mb-2" name="logo" accept="image/*,.svg">
                                <small class="text-muted d-block mb-2">Recommended: 200x60px, PNG/SVG, Max 2MB</small>
                                <button type="submit" class="btn btn-sm btn-primary">Upload Logo</button>
                                @if ($user->logo)
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteLogoModal">Remove</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Tab -->
        <div class="tab-pane fade" id="password" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.password') }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="current_password" required autocomplete="current-password">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Profile Image Modal -->
    <div class="modal fade" id="deleteProfileImageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove your profile image?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="profile_image" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Header Modal -->
    <div class="modal fade" id="deleteHeaderModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Portfolio Header</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove your portfolio header/banner?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="portfolio_header" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Logo Modal -->
    <div class="modal fade" id="deleteLogoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove your logo?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="logo" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success messages
            const alerts = document.querySelectorAll('.alert-success');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 3000);
            });
        });
    </script>
@endsection
