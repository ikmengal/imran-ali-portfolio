<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends AdminController
{
public function index(Request $request)
    {
        $filters = $this->getFilters(Testimonial::class);

        if ($request->ajax()) {
            $query = Testimonial::with('user:id,name')->ordered();
            $query = $this->scopeRecords($query);
            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', function ($testimonial) {
                    if ($testimonial->image) {
                        return '<img src="'.asset('storage/'.$testimonial->image).'" alt="" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">';
                    }

                    return '<div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i class="bx bx-user text-secondary"></i></div>';
                })
                ->addColumn('name', function ($testimonial) {
                    return '<div>
                        <h6 class="mb-0">'.e($testimonial->name).'</h6>
                        <small class="text-muted">'.e($testimonial->designation ?? '').($testimonial->company ? ' @ '.e($testimonial->company) : '').'</small>
                    </div>';
                })
                ->addColumn('rating', function ($testimonial) {
                    $stars = '';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= ($testimonial->rating ?? 5)) {
                            $stars .= '<i class="ti ti-star text-warning"></i>';
                        } else {
                            $stars .= '<i class="ti ti-star text-warning"></i>';
                        }
                    }

                    return $stars;
                })
                ->addColumn('message', function ($testimonial) {
                    return '<div class="text-truncate" style="max-width: 300px;">'.e($testimonial->message).'</div>';
                })
                ->addColumn('status', function ($testimonial) {
                    if ($testimonial->is_visible) {
                        return '<span class="badge bg-label-success">Visible</span>';
                    }

                    return '<span class="badge bg-label-secondary">Hidden</span>';
                })
                ->addColumn('actions', function ($testimonial) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                        if (auth()->user()->can('testimonials-show')) {
                            $actions .= '<a href="'.route('admin.testimonials.show', $testimonial).'" class="btn btn-sm btn-icon btn-label-info" title="View">
                                <i class="ti ti-eye"></i>
                            </a>';
                        }
                        if (auth()->user()->can('testimonials-edit')) {
                            $actions .= '<a href="'.route('admin.testimonials.edit', $testimonial).'" class="btn btn-sm btn-icon btn-label-primary" title="Edit">
                                <i class="ti ti-edit"></i>
                            </a>';
                        }
                        if (auth()->user()->can('testimonials-delete')) {
                            $actions .= '<button data-del-url="'.route('admin.testimonials.destroy', $testimonial).'" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>';
                        }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['image', 'name', 'rating', 'message', 'status', 'actions'])
            ->make(true);
        }
        return view('admin.testimonials.index');
    }

    public function create()
    {
        $this->authorize('create', Testimonial::class);

        return view('admin.testimonials.create');
    }

    public function store(TestimonialRequest $request)
    {
        $this->authorize('create', Testimonial::class);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        $this->authorize('view', $testimonial);
        $testimonial->load('user');

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->authorize('delete', $testimonial);

        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();

        return response()->json(['success' => true, 'message' => 'Testimonial deleted successfully.']);
    }

    public function toggleStatus(Request $request, Testimonial $testimonial)
    {
        $this->authorize('toggleStatus', $testimonial);

        $field = $request->get('field');
        if (in_array($field, ['is_visible'])) {
            $testimonial->update([$field => ! $testimonial->$field]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid field.'], 400);
    }
}
