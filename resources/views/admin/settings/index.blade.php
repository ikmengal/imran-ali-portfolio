@extends('admin.layouts.app')
@section('title', 'Settings')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/basic-dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab">
                        <i class="ti ti-settings me-2"></i> General
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="branding-tab" data-bs-toggle="pill" data-bs-target="#branding" type="button" role="tab">
                        <i class="ti ti-brand me-2"></i> Branding
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button" role="tab">
                        <i class="ti ti-phone me-2"></i> Contact
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button" role="tab">
                        <i class="ti ti-share me-2"></i> Social Links
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo" type="button" role="tab">
                        <i class="ti ti-search me-2"></i> SEO
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="settingsTabsContent">
        <!-- General Tab -->
        <div class="tab-pane fade show active" id="general" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">General Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label">Panel Name (Light)</label>
                            <input type="text" class="form-control" name="name" value="{{ $setting->name ?? '' }}" placeholder="Admin Panel">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Panel Name (Dark)</label>
                            <input type="text" class="form-control" name="white_name" value="{{ $setting->white_name ?? '' }}" placeholder="Admin Panel">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Footer Text</label>
                            <textarea class="form-control" name="footer_text" rows="2">{{ $setting->footer_text ?? '' }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save General Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Branding Tab -->
        <div class="tab-pane fade" id="branding" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Branding</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label">Logo (Light Mode)</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                @if ($setting->logo)
                                    <img src="{{ asset('admin/assets/settings/' . $setting->logo) }}" alt="Logo" class="rounded" style="height: 50px;">
                                @else
                                    <img src="{{ asset('admin/assets/logo/vertical-w-logo.png') }}" alt="Default Logo" class="rounded" style="height: 50px;">
                                @endif
                            </div>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                            <small class="text-muted">Recommended: 180x40px, PNG/JPG/SVG</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Logo (Dark Mode)</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                @if ($setting->white_logo)
                                    <img src="{{ asset('admin/assets/settings/' . $setting->white_logo) }}" alt="White Logo" class="rounded" style="height: 50px;">
                                @else
                                    <img src="{{ asset('admin/assets/logo/vertical-b-logo.png') }}" alt="Default White Logo" class="rounded" style="height: 50px;">
                                @endif
                            </div>
                            <input type="file" class="form-control" name="white_logo" accept="image/*">
                            <small class="text-muted">Recommended: 180x40px, PNG/JPG/SVG</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Favicon</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                @if ($setting->favicon)
                                    <img src="{{ asset('admin/assets/settings/' . $setting->favicon) }}" alt="Favicon" class="rounded" style="height: 32px;">
                                @else
                                    <img src="{{ asset('admin/assets/logo/favicon.png') }}" alt="Default Favicon" class="rounded" style="height: 32px;">
                                @endif
                            </div>
                            <input type="file" class="form-control" name="favicon" accept="image/ico,image/png">
                            <small class="text-muted">Recommended: 32x32px, ICO/PNG</small>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Branding</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Tab -->
        <div class="tab-pane fade" id="contact" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Contact Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $setting->email ?? '' }}" placeholder="admin@example.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $setting->phone ?? '' }}" placeholder="+92 300 1234567">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="2">{{ $setting->address ?? '' }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Contact Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Social Links Tab -->
        <div class="tab-pane fade" id="social" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Social Links</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-facebook text-primary me-2"></i> Facebook
                            </label>
                            <input type="url" class="form-control" name="social_links[facebook]" value="{{ $setting->social_links['facebook'] ?? '' }}" placeholder="https://facebook.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-twitter text-info me-2"></i> Twitter / X
                            </label>
                            <input type="url" class="form-control" name="social_links[twitter]" value="{{ $setting->social_links['twitter'] ?? '' }}" placeholder="https://twitter.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-linkedin text-primary me-2"></i> LinkedIn
                            </label>
                            <input type="url" class="form-control" name="social_links[linkedin]" value="{{ $setting->social_links['linkedin'] ?? '' }}" placeholder="https://linkedin.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-instagram text-danger me-2"></i> Instagram
                            </label>
                            <input type="url" class="form-control" name="social_links[instagram]" value="{{ $setting->social_links['instagram'] ?? '' }}" placeholder="https://instagram.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-youtube text-danger me-2"></i> YouTube
                            </label>
                            <input type="url" class="form-control" name="social_links[youtube]" value="{{ $setting->social_links['youtube'] ?? '' }}" placeholder="https://youtube.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="ti ti-brand-github text-dark me-2"></i> GitHub
                            </label>
                            <input type="url" class="form-control" name="social_links[github]" value="{{ $setting->social_links['github'] ?? '' }}" placeholder="https://github.com">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Social Links</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEO Tab -->
        <div class="tab-pane fade" id="seo" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">SEO Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <label class="form-label">Meta Data (JSON)</label>
                            <textarea class="form-control" name="meta_data" rows="6" placeholder='{"meta_title": "Admin Panel", "meta_description": "Admin panel description", "meta_keywords": "admin, panel, dashboard"}'>{!! json_encode($setting->meta_data ?? [], JSON_PRETTY_PRINT) !!}</textarea>
                            <small class="text-muted">Enter valid JSON format for SEO</small>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save SEO Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
@endsection
