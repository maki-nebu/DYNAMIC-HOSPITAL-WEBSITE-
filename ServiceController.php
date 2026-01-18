<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Directorate;
use App\Models\Log;
use App\Models\Service;
use App\Models\PublicationCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service_access', ['only' => ['index', 'show']]);
        $this->middleware('permission:service_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service_delete', ['only' => ['destroy', 'delete', 'permanent']]);
    }

    public function index()
    {
        try {
            $services = Service::latest()->get();
            return view('admin.service.index', compact('services'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function create()
    {
        try {
            $departments = Directorate::where('status', 1)->latest()->get();
            return view('admin.service.create', compact('departments'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function edit($id)
{
    try {
        $service = Service::find($id);
        $departments = Directorate::where('status', 1)->latest()->get();
        $editDepartment = $service->directorate_id; // Set the selected department for editing
        return view('admin.service.edit', compact('service', 'departments', 'editDepartment'));
    } catch (\Throwable $th) {
        return redirect()->back()->with('infoMsg', $th->getMessage());
    }
}
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'icon' => 'required',
                'directorate_id' => 'required'
            ]);

            $service = Service::create([
                'name' => $request->name,
                'icon' => $request->icon,
                'description' => $request->description,
                'directorate_id' => $request->directorate_id,
            ]);
            $service->save();

            $log = new Log();
            $log->action = "A New Service Created";
            $log->user_id = Auth::user()->id;
            $log->save();
            toast('Service Successfully Saved!', 'success');
            return redirect()->route('admin.services');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'icon' => 'required',
                'directorate_id' => 'required',
            ]);
            $service = Service::find($id);
            $service->name = $request->name;
            $service->icon = $request->icon;
            $service->description = $request->description;
            $service->directorate_id = $request->directorate_id;
            $service->save();

            $log = new Log();
            $log->action = "A service information updated";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->route('admin.services')->with('successMsg', 'Service Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function restore(int $id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);
            $service->restore();
            toast('Service Restored!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function onlyTrashed()
    {
        try {
            $services = Service::onlyTrashed()->get();
            return view('admin.service.trashed', compact('services'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function permanent(Request $request, $id)
    {
        try {
            Service::onlyTrashed()->find($id)->forceDelete();
            $log = new Log();
            $log->action = " An Service deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            toast('Permanently Deleted Succesfully!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function status($id)
    {
        try {
            $item = Service::findOrFail($id);
            $item->status = !$item->status;
            $item->save();
            $log = new Log();
            $log->action = "A Service activated / deactivated";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Service Activated / Deactivated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function delete(Request $request, $id)
    {
        try {
            $service = Service::find($id);
            $service->delete();
            $log = new Log();
            $log->action = " An Service deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            toast('Permanently Deleted Succesfully!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
