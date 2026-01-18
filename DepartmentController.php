<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:sector_access', ['only' => ['index', 'show']]);
        $this->middleware('permission:sector_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sector_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sector_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        try {
            $departments = Department::latest()->get();
            return view('admin.department.index', compact('departments'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function create()
    {
        try {
            $department = Department::where('status', 1)->latest()->get();
            return view('admin.department.create', compact('department'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'department_name' => 'required',
                'description' => 'required',
                'director_name' => 'required',
                'director_photo' => 'required',
                'department_photo' => 'required',
                'vice_director' => 'required',
                'icon' => 'required',
                'vice_director_photo' => 'required',
            ]);

            $image1 = $request->file('director_photo');
            $slug = Str::slug($request->director_name);
            if (isset($image1)) {
                $currentDate = Carbon::now()->toDateString();
                $imagename1 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image1->getClientOriginalExtension();

                if (!file_exists('uploads/Department')) {
                    mkdir('uploads/Department', 0777, true);
                }
                $image1->move('uploads/Department', $imagename1);
            } else {
                $imagename1 = "default.png";
            }

            $image2 = $request->file('vice_director_photo');
            $slug = Str::slug($request->vice_director);
            if (isset($image2)) {
                $currentDate = Carbon::now()->toDateString();
                $imagename2 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image2->getClientOriginalExtension();

                if (!file_exists('uploads/Department')) {
                    mkdir('uploads/Department', 0777, true);
                }
                $image2->move('uploads/Department', $imagename2);
            } else {
                $imagename2 = "default.png";
            }
            $image2 = $request->file('department_photo');
            $slug = Str::slug($request->vice_director);
            if (isset($image2)) {
                $currentDate = Carbon::now()->toDateString();
                $imagename3 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image2->getClientOriginalExtension();

                if (!file_exists('uploads/Department')) {
                    mkdir('uploads/Department', 0777, true);
                }
                $image2->move('uploads/Department', $imagename3);
            } else {
                $imagename3 = "default.png";
            }
            $banner = Department::create([
                'department_name' => $request->department_name,
                'slug' => Str::slug($request->department_name),
                'description' => $request->description,
                'director_name' => $request->director_name,
                'vice_director' => $request->vice_director,
                'icon' => $request->icon,
                'vice_director_photo' => $imagename1,
                'director_photo' => $imagename2,
                'department_photo' => $imagename3,
            ]);
            $banner->save();

            $log = new Log();
            $log->action = "A New Department Created";
            $log->user_id = Auth::user()->id;
            $log->save();

            return redirect()->route('admin.departments')->with('successMsg', 'Department Successfully Saved');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $department = Department::find($id);
            return view('admin.department.edit', compact('department'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
             
            ]);

            $department = Department::find($id);
            $slug = Str::slug($request->director_name);

            if ($request->hasFile('director_photo')) {
                $image1 = $request->file('director_photo');
                $currentDate = Carbon::now()->toDateString();
                $imagename1 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image1->getClientOriginalExtension();

                if (!file_exists('uploads/Department')) {
                    mkdir('uploads/Department', 0777, true);
                }
                $image1->move('uploads/Department', $imagename1);
                $department->director_photo = $imagename1;
            } else {
                $imagename1 = "default.png";
            }
            if ($request->hasFile('department_photo')) {
                $image2 = $request->file('department_photo');
                $currentDate = Carbon::now()->toDateString();
                $imagename2 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image2->getClientOriginalExtension();

                if (!file_exists('uploads/Department')) {
                    mkdir('uploads/Department', 0777, true);
                }
                $image2->move('uploads/Department', $imagename2);
                $department->department_photo = $imagename2;
            } else {
                $imagename2 = "default.png";
            }

            if ($request->hasFile('vice_director_photo')) {
                $image2 = $request->file('vice_director_photo');
                $slug = Str::slug($request->vice_director);
                $currentDate = Carbon::now()->toDateString();
                $imagename2 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image2->getClientOriginalExtension();

                if (!file_exists('uploads/Department')) {
                    mkdir('uploads/Department', 0777, true);
                }
                $image2->move('uploads/Department', $imagename2);
                $department->vice_director_photo = $imagename2;
            } else {
                $imagename2 = "default.png";
            }
            $department->department_name = $request->department_name;
            $department->slug = Str::slug($request->department_name);
            $department->description = $request->description;
            $department->director_name = $request->director_name;
            $department->vice_director = $request->vice_director;
            $department->icon = $request->icon;
            $department->save();

            $log = new Log();
            $log->action = "A Department updated";
            $log->user_id = Auth::user()->id;
            $log->save();

            return redirect()->route('admin.departments')->with('successMsg', 'Department Successfully Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function status($id)
    {
        try {
            $item = Department::findOrFail($id);
            $item->status = !$item->status;
            $item->save();
            $log = new Log();
            $log->action = "A Department activated / deactivated";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Department Activated / Deactivated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function destroy(Department $department)
    {
        try {
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
        //
    }
}
