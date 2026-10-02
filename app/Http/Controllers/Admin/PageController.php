<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PageController extends AdminController
{
    public function index(Request $request)
    {
        $filters = $this->getFilters(Page::class);

        if ($request->ajax()) {
            $query = Page::query();

            $query = $this->applyFilters($query, $request, $filters);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('title', function ($page) {
                    return '<h6 class="mb-0">' . e($page->title) . '</h6>';
                })
                ->addColumn('slug', function ($page) {
                    return '<code class="text-sm">' . e($page->slug) . '</code>';
                })
                ->addColumn('status', function ($page) {
                    $badges = [];
                    if ($page->is_visible) {
                        $badges[] = '<span class="badge bg-label-success me-1">Visible</span>';
                    } else {
                        $badges[] = '<span class="badge bg-label-secondary me-1">Hidden</span>';
                    }
                    if ($page->show_in_footer) {
                        $badges[] = '<span class="badge bg-label-info">Footer</span>';
                    }
                    return '<div class="d-flex flex-wrap">' . implode('', $badges) . '</div>';
                })
                ->addColumn('created_at', function ($page) {
                    return '<small>' . $page->created_at->format('M d, Y') . '</small>';
                })
                ->addColumn('actions', function ($page) {
                    $actions = '<div class="d-flex justify-content-end gap-2">';
                    if (auth()->user()->can('pages-show')) {
                        $actions .= '<a href="' . route('admin.pages.show', $page) . '" class="btn btn-sm btn-icon btn-label-info" title="View"><i class="ti ti-eye"></i></a>';
                    }
                    if (auth()->user()->can('pages-edit')) {
                        $actions .= '<a href="' . route('admin.pages.edit', $page) . '" class="btn btn-sm btn-icon btn-label-primary" title="Edit"><i class="ti ti-edit"></i></a>';
                    }
                    if (auth()->user()->can('pages-delete')) {
                        $actions .= '<button data-del-url="' . route('admin.pages.destroy', $page) . '" class="btn btn-sm btn-icon btn-label-danger delete" title="Delete"><i class="ti ti-trash"></i></button>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['title', 'slug', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.pages.index');
    }

    public function create()
    {
        $this->authorize('create', Page::class);
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Page::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_visible' => 'boolean',
            'show_in_footer' => 'boolean',
            'sort_order' => 'nullable|integer',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'banner_alt' => 'nullable|string|max:255',
            'banner_overlay' => 'boolean',
        ]);

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = 'page_banner_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pages', $filename, 'public');
            $validated['banner_image'] = $filename;
        }

        $validated['banner_overlay'] = $request->boolean('banner_overlay');
        $validated['banner_alt'] = $request->input('banner_alt');

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function show(Page $page)
    {
        $this->authorize('view', $page);
        return view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        $this->authorize('update', $page);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $this->authorize('update', $page);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_visible' => 'boolean',
            'show_in_footer' => 'boolean',
            'sort_order' => 'nullable|integer',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'banner_alt' => 'nullable|string|max:255',
            'banner_overlay' => 'boolean',
            'remove_banner' => 'nullable|boolean',
        ]);

        // Handle banner removal
        if ($request->boolean('remove_banner') && $page->banner_image) {
            Storage::disk('public')->delete('pages/' . $page->banner_image);
            $validated['banner_image'] = null;
            $validated['banner_alt'] = null;
        }

        // Handle new banner upload
        if ($request->hasFile('banner_image')) {
            // Delete old banner if exists
            if ($page->banner_image) {
                Storage::disk('public')->delete('pages/' . $page->banner_image);
            }
            $file = $request->file('banner_image');
            $filename = 'page_banner_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pages', $filename, 'public');
            $validated['banner_image'] = $filename;
        }

        $validated['banner_overlay'] = $request->boolean('banner_overlay');
        $validated['banner_alt'] = $request->input('banner_alt');

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $this->authorize('delete', $page);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
