<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewService;
use Illuminate\Support\Str;

class NewServiceController extends Controller
{
    // Admin: List services
    public function index()
    {
        $services = NewService::all();
        return view('admin.new_service.index', compact('services'));
    }

    // Admin: Create form
    public function create()
    {
        return view('admin.new_service.create');
    }

    // Admin: Store new service
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'icon' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/services'), $imageName);
        }

        NewService::create([
            'name' => $request->name,
            'directorate_id' => $request->directorate_id ?? 0,
            'description' => $request->description,
            'icon' => $request->icon,
            'image' => $imageName,
            'status' => 1
        ]);

        return redirect()->route('admin.new_services.index')->with('success', 'Service created successfully.');
    }

    // Admin: Edit form
    public function edit($id)
    {
        $service = NewService::findOrFail($id);
        return view('admin.new_service.edit', compact('service'));
    }

    // Admin: Update service
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'icon' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);

        $service = NewService::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
                unlink(public_path('uploads/services/' . $service->image));
            }

            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/services'), $imageName);
            $service->image = $imageName;
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->icon = $request->icon;
        $service->save();

        return redirect()->route('admin.new_services.index')->with('success', 'Service updated successfully.');
    }

    // Admin: Delete service
    public function destroy($id)
    {
        $service = NewService::findOrFail($id);
        if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            unlink(public_path('uploads/services/' . $service->image));
        }
        $service->delete();

        return redirect()->route('admin.new_services.index')->with('success', 'Service deleted successfully.');
    }

    // Frontend: Display services
    public function front()
    {
        $services = NewService::where('status', 1)->get();
        return view('front.new_services', compact('services'));
    }
}
