<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends AdminController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $testimonials = Testimonial::ordered();
            return DataTables::of($testimonials)
                ->addColumn('image', function ($testimonial) {
                    if ($testimonial->image) {
                        return '<img src="' . asset('storage/' . $testimonial->image) . '" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">';
                    }
                    return '<div class="avatar avatar-sm bg-label-primary"><i class="bx bx-user"></i></div>';
                })
                ->addColumn('name', function ($testimonial) {
                    return '<div>
                        <h6 class="mb-1">' . e($testimonial->name) . '</h6>
                        <small class="text-muted">' . e($testimonial->designation ?? '') . ' ' . ($testimonial->company ? 'at ' . e($testimonial->company) : '') . '</small>
                    </div>';
                })
                ->addColumn('message', function ($testimonial) {
                    return '<small class="text-muted">' . e(Str::limit($testimonial->message, 100)) . '</small>';
                })
                ->addColumn('rating', function ($testimonial) {
                    $stars = '';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $testimonial->rating) {
                            $stars .= '<i class="bx bxs-star text-warning"></i>';
                        } else {
                            $stars .= '<i class="bx bx-star text-warning"></i>';
                        }
                    }
                    return $stars;
                })
                ->addColumn('status', function ($testimonial) {
                    if ($testimonial->is_visible) {
                        return '<span class="badge bg-label-success">Visible</span>';
                    }
                    return '<span class="badge bg-label-secondary">Hidden</span>';
                })
                ->addColumn('sort_order', function ($testimonial) {
                    return $testimonial->sort_order ?? 0;
                })
                ->addColumn('actions', function ($testimonial) {
                    return '<div class="d-flex justify-content-end gap-2">
                        <a href="' . route('admin.testimonials.edit', $testimonial) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="bx bx-edit"></i></a>
                        <form method="POST" action="' . route('admin.testimonials.destroy', $testimonial) . '" onsubmit="return confirm(\'Are you sure you want to delete this testimonial?\')" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-icon btn-label-danger" title="Delete"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>';
                })
                ->rawColumns(['image', 'name', 'message', 'rating', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.testimonials.index');
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['is_visible'] = $request->boolean('is_visible', true);
        $validated['user_id'] = auth()->id();

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                \Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['is_visible'] = $request->boolean('is_visible', true);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            \Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}