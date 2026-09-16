@extends('admin.layouts.app')

@section('title', 'Settings')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/basic-dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
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

                <div class="col-md-6">
                    <label class="form-label">Footer Text</label>
                    <textarea class="form-control" name="footer_text" rows="2">{{ $setting->footer_text ?? '' }}</textarea>
                </div>

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
                    <label class="form-label">Social Links (JSON)</label>
                    <textarea class="form-control" name="social_links" rows="4" placeholder='{"facebook": "https://facebook.com", "twitter": "https://twitter.com", "linkedin": "https://linkedin.com", "instagram": "https://instagram.com"}'>{!! json_encode($setting->social_links ?? [], JSON_PRETTY_PRINT) !!}</textarea>
                    <small class="text-muted">Enter valid JSON format</small>
                </div>

                <div class="col-12">
                    <label class="form-label">Meta Data (JSON)</label>
                    <textarea class="form-control" name="meta_data" rows="4" placeholder='{"meta_title": "Admin Panel", "meta_description": "Admin panel description", "meta_keywords": "admin, panel, dashboard"}'>{!! json_encode($setting->meta_data ?? [], JSON_PRETTY_PRINT) !!}</textarea>
                    <small class="text-muted">Enter valid JSON format for SEO</small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
@endsection