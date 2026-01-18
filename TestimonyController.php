<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Testimony;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TestimonyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:testimony_access', ['only' => ['index', 'show']]);
        $this->middleware('permission:testimony_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:testimony_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:testimony_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        try {
            $testimonails = Testimony::orderByDesc('updated_at')->get();
            return view('admin.testimony.index', compact('testimonails'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function create()
    {
        try {
            return view('admin.testimony.create');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function enable($id)
    {
        try {
            $testimony = Testimony::find($id);
            if ($testimony->is_enabled == 1) {
                $testimony->is_enabled = 0;
                $testimony->save();
                $log = new Log();
                $log->action = "A Testimony Disabled";
                $log->user_id = Auth::user()->id;
                $log->save();

                return redirect()->route('admin.testimonies')->with('successMsg', 'Testimony Successfully Disabled');
            } else {
                $testimony->is_enabled = 1;
                $testimony->save();
                $log = new Log();
                $log->action = "A Testimony Enabled";
                $log->user_id = Auth::user()->id;
                $log->save();
                return redirect()->route('admin.testimonies')->with('successMsg', 'Testimony Successfully Enabled!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'fullname' => 'required',
                'title' => 'required',
                'content' => 'required',
                'image' => 'required|mimes:jpeg,jpg,bmp,png',
            ]);
            $image = $request->file('image');
            $slug = Str::slug($request->name);
            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                if (!file_exists('uploads/Testimony')) {
                    mkdir('uploads/Testimony', 0777, true);
                }
                $image->move('uploads/Testimony', $imagename);
            } else {
                $imagename = "default.png";
            }
            $testimony = Testimony::create([
                'fullname' => $request->fullname,
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagename,
                'is_enabled' => $request->is_enabled,
            ]);
            $testimony->save();

            $log = new Log();
            $log->action = "A New Testimony Created";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->route('admin.testimonies')->with('successMsg', 'Testimony Successfully Saved!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $testimony = Testimony::find($id);
            return view('admin.testimony.edit', compact('testimony'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'fullname' => 'required',
                'title' => 'required',
                'content' => 'required',
            ]);
            $testimony = Testimony::find($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $slug = Str::slug($request->name);
                if (isset($image)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    if (!file_exists('uploads/Testimony')) {
                        mkdir('uploads/Testimony', 0777, true);
                    }
                    $image->move('uploads/Testimony', $imagename);
                    $testimony->image = $imagename;
                } else {
                    $imagename = "default.png";
                    $testimony->image = $imagename;
                }
            }
            $testimony->title = $request->title;
            $testimony->fullname = $request->fullname;
            $testimony->content = $request->content;
            $testimony->save();

            $log = new Log();
            $log->action = "A testimony information updated";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->route('admin.testimonies')->with('successMsg', 'Testimony Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function restore(int $id)
    {
        try {
            $testimony = Testimony::onlyTrashed()->findOrFail($id);
            $testimony->restore();
            return redirect()->back()->with('Testimony Restored!', 'success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function onlyTrashed()
    {
        try {
            $testimonails = Testimony::onlyTrashed()->get();
            return view('admin.testimony.trashed', compact('testimonails'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function permanent(Request $request, $id)
    {
        try {
            Testimony::onlyTrashed()->find($id)->forceDelete();
            $log = new Log();
            $log->action = "A Testimony deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Permanently Deleted Succesfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function delete(Request $request, $id)
    {
        try {
            $testimony = Testimony::find($id);
            $testimony->delete();
            $log = new Log();
            $log->action = "A Testimony deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Deleted Succesfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
