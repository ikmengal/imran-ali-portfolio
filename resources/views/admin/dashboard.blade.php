@extends('admin.layouts.app')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/chartjs/chartjs.css') }}" />
@endpush
@section('content')
    <div class="row">
        <!-- Stats Overview Cards -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Total Projects</h6>
                            <h3 class="mb-0">{{ $stats['projects'] }}</h3>
                            <small class="text-{{ $analytics['projects_growth'] >= 0 ? 'success' : 'danger' }}">
                                <i class="ti ti-caret-{{ $analytics['projects_growth'] >= 0 ? 'up' : 'down' }}"></i>
                                {{ abs($analytics['projects_growth']) }}% vs last month
                            </small>
                        </div>
                        <div class="badge bg-label-primary p-3 rounded stats-icon">
                            <i class="ti ti-folder ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="text-success"><i class="ti ti-eye"></i> {{ $analytics['visible_projects'] }} Visible</span>
                        <span class="text-warning"><i class="ti ti-star"></i> {{ $analytics['featured_projects'] }} Featured</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Featured Projects</h6>
                            <h3 class="mb-0">{{ $stats['featured_projects'] }}</h3>
                            <small class="text-muted">Showcased on portfolio</small>
                        </div>
                        <div class="badge bg-label-warning p-3 rounded stats-icon">
                            <i class="ti ti-star ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="text-info"><i class="ti ti-git-branch"></i> {{ $stats['github_projects'] }} on GitHub</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Total Skills</h6>
                            <h3 class="mb-0">{{ $stats['skills'] }}</h3>
                            <small class="text-{{ $analytics['skills_growth'] >= 0 ? 'success' : 'danger' }}">
                                <i class="ti ti-caret-{{ $analytics['skills_growth'] >= 0 ? 'up' : 'down' }}"></i>
                                {{ abs($analytics['skills_growth']) }}% vs last month
                            </small>
                        </div>
                        <div class="badge bg-label-secondary p-3 rounded stats-icon">
                            <i class="ti ti-code ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="text-success"><i class="ti ti-eye"></i> {{ $analytics['visible_skills'] }} Visible</span>
                        <span class="text-warning"><i class="ti ti-star"></i> {{ $analytics['featured_skills'] }} Featured</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Total Experiences</h6>
                            <h3 class="mb-0">{{ $stats['experiences'] }}</h3>
                            <small class="text-muted">{{ $analytics['visible_experiences'] }} visible on portfolio</small>
                        </div>
                        <div class="badge bg-label-info p-3 rounded stats-icon">
                            <i class="ti ti-briefcase ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="text-primary"><i class="ti ti-clock"></i> {{ $analytics['current_experiences'] }} Current</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Education Records</h6>
                            <h3 class="mb-0">{{ $stats['education'] }}</h3>
                            <small class="text-muted">{{ $analytics['visible_education'] }} visible on portfolio</small>
                        </div>
                        <div class="badge bg-label-success p-3 rounded stats-icon">
                            <i class="ti ti-school ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="text-info"><i class="ti ti-book"></i> {{ $analytics['current_education'] }} Current</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Total Services</h6>
                            <h3 class="mb-0">{{ $stats['services'] }}</h3>
                            <small class="text-muted">{{ $analytics['visible_services'] }} visible on portfolio</small>
                        </div>
                        <div class="badge bg-label-secondary p-3 rounded stats-icon">
                            <i class="ti ti-tool ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="secondary"><i class="ti ti-star"></i> {{ $analytics['featured_services'] }} Featured</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Testimonials</h6>
                            <h3 class="mb-0">{{ $stats['testimonials'] }}</h3>
                            <small class="text-muted">{{ $analytics['visible_testimonials'] }} visible on portfolio</small>
                        </div>
                        <div class="badge bg-label-warning p-3 rounded stats-icon">
                            <i class="ti ti-quote ti-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Contact Messages</h6>
                            <h3 class="mb-0">{{ $stats['messages'] }}</h3>
                            <small class="text-{{ $analytics['messages_growth'] >= 0 ? 'success' : 'danger' }}">
                                <i class="ti ti-caret-{{ $analytics['messages_growth'] >= 0 ? 'up' : 'down' }}"></i>
                                {{ abs($analytics['messages_growth']) }}% vs last month
                            </small>
                        </div>
                        <div class="badge bg-label-danger p-3 rounded stats-icon">
                            <i class="ti ti-mail ti-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-4 text-sm">
                        <span class="text-danger"><i class="ti ti-mail"></i> {{ $stats['unread_messages'] }} Unread</span>
                        <span class="text-success"><i class="ti ti-mail-opened"></i> {{ $stats['messages'] - $stats['unread_messages'] }} Read</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card h-100 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">GitHub Projects</h6>
                            <h3 class="mb-0">{{ $stats['github_projects'] }}</h3>
                            <small class="text-muted">Projects with GitHub links</small>
                        </div>
                        <div class="badge bg-dark p-3 rounded stats-icon">
                            <i class="ti ti-git-branch ti-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="col-lg-8 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Portfolio Growth (Last 6 Months)</h5>
                        <small class="text-muted">Monthly creation trends</small>
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active" data-chart="projects">Projects</button>
                        <button type="button" class="btn btn-outline-secondary" data-chart="skills">Skills</button>
                        <button type="button" class="btn btn-outline-secondary" data-chart="messages">Messages</button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="growthChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Skills Proficiency Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="proficiencyChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Skills by Category</h5>
                </div>
                <div class="card-body">
                    <canvas id="skillsCategoryChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Projects by Category</h5>
                </div>
                <div class="card-body">
                    <canvas id="projectsCategoryChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Items & Activity Row -->
        <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Recent Projects</h5>
                        <small class="text-muted">Latest portfolio additions</small>
                    </div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if ($analytics['recent_projects']->isEmpty())
                        <div class="text-center py-4">
                            <i class="ti ti-folder text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mb-0 mt-2">No projects added yet</p>
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm mt-2">Add First Project</a>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($analytics['recent_projects'] as $project)
                                <a href="{{ route('admin.projects.show', $project) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-3">
                                            @if ($project->image)
                                                <img src="{{ asset('storage/' . $project->image) }}" alt="" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="ti ti-image text-secondary"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $project->title }}</h6>
                                                <small class="text-muted">{{ $project->category ?? 'Uncategorized' }}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($project->is_featured)
                                                <span class="badge bg-label-warning">Featured</span>
                                            @endif
                                            @if ($project->is_visible)
                                                <span class="badge bg-label-success">Visible</span>
                                            @else
                                                <span class="badge bg-label-secondary">Hidden</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Recent Messages</h5>
                        <small class="text-muted">Latest contact form submissions</small>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if ($analytics['recent_messages']->isEmpty())
                        <div class="text-center py-4">
                            <i class="ti ti-envelope text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mb-0">No messages yet</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($analytics['recent_messages'] as $message)
                                <a href="{{ route('admin.messages.show', $message) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 {{ $message->read_at ? '' : 'fw-bold' }}">{{ $message->name }}</h6>
                                            <small class="text-muted">{{ $message->email }}</small>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                            @if (!$message->read_at)
                                                <span class="badge bg-label-danger ms-2">New</span>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-1 text-truncate" style="max-width: 300px;">{{ $message->subject ?: 'No subject' }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity Logs -->
        <div class="col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Recent Activity</h5>
                        <small class="text-muted">Latest changes and updates</small>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-secondary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if (empty($recentActivity))
                        <div class="text-center py-4">
                            <i class="ti ti-clock text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mb-0">No recent activity</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($recentActivity as $activity)
                                <a href="{{ $activity['url'] }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="badge bg-label-{{ $activity['color'] }} p-2 rounded-circle">
                                            <i class="ph {{ $activity['icon'] }}"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-1">{!! $activity['description'] !!}</p>
                                            <small class="text-muted">{{ $activity['time'] }}</small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        {{-- <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-folder-simple-plus ti-lg"></i>
                                <span>Add Project</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.experiences.create') }}" class="btn btn-outline-info w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-briefcase ti-lg"></i>
                                <span>Add Experience</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.education.create') }}" class="btn btn-outline-success w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-graduation-cap ti-lg"></i>
                                <span>Add Education</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.skills.create') }}" class="btn btn-outline-secondary w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-code ti-lg"></i>
                                <span>Add Skill</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.services.create') }}" class="btn btn-outline-warning w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-wrench ti-lg"></i>
                                <span>Add Service</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-danger w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-chat-circle-text ti-lg"></i>
                                <span>Add Testimonial</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-dark w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-envelope ti-lg"></i>
                                <span>View Messages</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-info w-100 py-3 d-flex flex-column align-items-center gap-2">
                                <i class="ti ti-gear ti-lg"></i>
                                <span>Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script>
        // Chart colors matching the theme
        const chartColors = {
            primary: '#696cff',
            secondary: '#8592a3',
            success: '#28c76f',
            info: '#00cfe8',
            warning: '#ff9f43',
            danger: '#ea5455',
            dark: '#181c2e',
            light: '#f3f6f9'
        };

        // Monthly Growth Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        const monthlyProjects = @json($monthlyProjects);
        const monthlySkills = @json($monthlySkills);
        const monthlyMessages = @json($monthlyMessages);

        let growthChart = new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: monthlyProjects.labels,
                datasets: [
                    {
                        label: 'Projects',
                        data: monthlyProjects.data,
                        borderColor: chartColors.primary,
                        backgroundColor: 'rgba(105, 108, 255, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Skills',
                        data: monthlySkills.data,
                        borderColor: chartColors.secondary,
                        backgroundColor: 'rgba(133, 146, 163, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        hidden: true
                    },
                    {
                        label: 'Messages',
                        data: monthlyMessages.data,
                        borderColor: chartColors.danger,
                        backgroundColor: 'rgba(234, 84, 85, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        hidden: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: chartColors.dark,
                        titleFont: { size: 13 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        displayColors: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { stepSize: 1 }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Chart toggle buttons
        document.querySelectorAll('[data-chart]').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('[data-chart]').forEach(b => b.classList.remove('active', 'btn-primary', 'btn-secondary'));
                this.classList.add('active');

                const chartType = this.dataset.chart;
                growthChart.data.datasets.forEach((dataset, index) => {
                    const labels = ['projects', 'skills', 'messages'];
                    if (labels[index] === chartType) {
                        growthChart.show(index);
                        this.classList.add('btn-primary');
                        this.classList.remove('btn-outline-primary', 'btn-outline-secondary');
                    } else {
                        growthChart.hide(index);
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-outline-secondary');
                    }
                });
            });
        });

        // Skills Proficiency Chart (Doughnut)
        const proficiencyCtx = document.getElementById('proficiencyChart').getContext('2d');
        const proficiencyData = @json($skillsProficiency);

        new Chart(proficiencyCtx, {
            type: 'doughnut',
            data: {
                labels: proficiencyData.map(p => p.level),
                datasets: [{
                    data: proficiencyData.map(p => p.count),
                    backgroundColor: [
                        chartColors.success,
                        chartColors.info,
                        chartColors.warning,
                        chartColors.secondary,
                        chartColors.light
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: { size: 11 }
                        }
                    },
                    tooltip: {
                        backgroundColor: chartColors.dark,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.raw / total) * 100).toFixed(1);
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Skills by Category Chart (Horizontal Bar)
        const skillsCatCtx = document.getElementById('skillsCategoryChart').getContext('2d');
        const skillsCatData = @json($skillsByCategory);

        new Chart(skillsCatCtx, {
            type: 'bar',
            data: {
                labels: skillsCatData.map(s => s.category || 'Uncategorized'),
                datasets: [{
                    label: 'Count',
                    data: skillsCatData.map(s => s.count),
                    backgroundColor: 'rgba(105, 108, 255, 0.8)',
                    borderRadius: 6,
                    maxBarThickness: 40
                }, {
                    label: 'Avg Proficiency %',
                    data: skillsCatData.map(s => Math.round(Number(s.avg_percentage) || 0)),
                    type: 'line',
                    borderColor: chartColors.warning,
                    backgroundColor: chartColors.warning,
                    yAxisID: 'y1',
                    tension: 0.3,
                    pointRadius: 4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { usePointStyle: true, font: { size: 11 } }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    y: {
                        grid: { display: false }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        min: 0,
                        max: 100,
                        grid: { drawOnChartArea: false },
                        title: { display: true, text: 'Proficiency %', font: { size: 10 } }
                    }
                }
            }
        });

        // Projects by Category Chart (Pie)
        const projectsCatCtx = document.getElementById('projectsCategoryChart').getContext('2d');
        const projectsCatData = @json($projectsByCategory);
        const pieColors = [
            chartColors.primary, chartColors.info, chartColors.success,
            chartColors.warning, chartColors.danger, chartColors.secondary
        ];

        new Chart(projectsCatCtx, {
            type: 'pie',
            data: {
                labels: projectsCatData.map(p => p.category || 'Uncategorized'),
                datasets: [{
                    data: projectsCatData.map(p => p.count),
                    backgroundColor: pieColors.slice(0, projectsCatData.length),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: { size: 11 }
                        }
                    },
                    tooltip: {
                        backgroundColor: chartColors.dark,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.raw / total) * 100).toFixed(1);
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
