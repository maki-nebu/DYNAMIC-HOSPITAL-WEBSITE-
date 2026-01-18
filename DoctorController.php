<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Show list of doctors (Frontend)
    public function index()
    {
        $doctors = Doctor::with('department')->get();
        $specialties = Doctor::select('specialty')->distinct()->pluck('specialty');

        return view('front.doctor', compact('doctors', 'specialties'));
    }

    // Show the edit form
    public function edit($id)
    {
        try {
            $doctor = Doctor::find($id);
            $departments = Department::where('status', 1)->get();

            return view('admin.doctors.edit', compact('doctor', 'departments'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    // Update doctor
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->name = $request->name;
        $doctor->slug = Str::slug($request->name);
        $doctor->specialty = $request->specialty;
        $doctor->bio = $request->bio;
        $doctor->available_days = $request->available_days;
        $doctor->department_id = $request->department_id;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/Doctor'), $imageName);
            $doctor->image = $imageName;
        }

        $doctor->save();

        return redirect()->route('admin.doctors.index')->with('successMsg', 'Doctor updated successfully.');
    }

    // Admin doctors list
    public function adminIndex()
    {
        $doctors = Doctor::with('department')->latest()->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    // Admin create page
    public function create()
    {
        $departments = Department::all();
        return view('admin.doctors.create', compact('departments'));
    }

    // Store doctor
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png',
            'specialty'     => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
            'bio'           => 'nullable|string',
            'available_days'=> 'nullable|string|max:255',
        ]);

        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->specialty = $request->specialty;
        $doctor->department_id = $request->department_id;
        $doctor->bio = $request->bio;
        $doctor->available_days = $request->available_days;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/Doctor'), $imageName);
            $doctor->image = $imageName;
        }

        $doctor->save();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor added successfully.');
    }

    // Permanently delete doctor
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Delete doctor image if exists
        if ($doctor->image && file_exists(public_path('uploads/Doctor/' . $doctor->image))) {
            unlink(public_path('uploads/Doctor/' . $doctor->image));
        }

        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor permanently deleted.');
    }
}
