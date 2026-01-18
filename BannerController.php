<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Log;
use App\Testimony;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:banner_access', ['only' => ['index']]);
        $this->middleware('permission:banner_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:banner_edit', ['only' => ['edit', 'bannerupdate','index']]);
        $this->middleware('permission:banner_delete', ['only' => ['delete']]);
    }
    

    public function index()
    {
        try {
            $banners = Banner::orderByDesc('updated_at')->get();
            return view('admin.banner.index', compact('banners'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function create()
    {
        try {
            return view('admin.banner.create');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title_am' => 'required',
                'subtitle_am' => 'required',
                'title_en' => 'required',
                'subtitle_en' => 'required',
                'title_or' => 'required',
                'subtitle_or' => 'required',
                'image' => 'required|mimes:jpeg,jpg,bmp,png,svg',
            ]);

            $image = $request->file('image');
            $slug = Str::slug($request->name);
            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                if (!file_exists('uploads/Banner')) {
                    mkdir('uploads/Banner', 0777, true);
                }
                $image->move('uploads/Banner', $imagename);
            } else {
                $imagename = "default.png";
            }
            $banner = Banner::create([
                'title_am' => $request->title_am,
                'subtitle_am' => $request->subtitle_am,
                'title_en' => $request->title_en,
                'subtitle_en' => $request->subtitle_en,
                'title_or' => $request->title_or,
                'subtitle_or' => $request->subtitle_or,
                'image' => $imagename,
            ]);
            $banner->save();

            $log = new Log();
            $log->action = "A New Banner Created";
            $log->user_id = Auth::user()->id;
            $log->save();

            return redirect()->route('admin.banners')->with('successMsg', 'Slider Successfully Saved');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $banner = Banner::find($id);
            return view('admin.banner.edit', compact('banner'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function bannerupdate(Request $request, $id)
    {
        try {
            // $this->validate($request, [
            //     'subtitle' => 'required',
            //     'title' => 'required',
            // ]);
            $banner = Banner::find($id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $slug = Str::slug($request->name);
                if (isset($image)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    if (!file_exists('uploads/Banner')) {
                        mkdir('uploads/Banner', 0777, true);
                    }
                    $image->move('uploads/Banner', $imagename);
                    $banner->image = $imagename;
                } else {
                    $imagename = "default.png";
                    $banner->image = $imagename;
                }
            }
            $banner->title_en = $request->title_en;
            $banner->subtitle_en = $request->subtitle_en;
            $banner->title_am = $request->title_am;
            $banner->subtitle_am = $request->subtitle_am;
            $banner->title_or = $request->title_or;
            $banner->subtitle_or = $request->subtitle_or;
            $banner->save();

            $log = new Log();
            $log->action = "A Slider information updated";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->route('admin.banners')->with('successMsg', 'Slider Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function restore(int $id)
    {
        try {
            $banner = Banner::onlyTrashed()->findOrFail($id);
            $banner->restore();
            return redirect()->back()->with('successMsg', 'Banner Restored!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function onlyTrashed()
    {
        try {
            $banners = Banner::onlyTrashed()->get();
            return view('admin.banner.trashed', compact('banners'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function permanent(Request $request, $id)
    {
        try {
            Banner::onlyTrashed()->find($id)->forceDelete();
            $log = new Log();
            $log->action = "A Banner deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Permanently Deleted Succesfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function status($id)
    {
        try {
            if (Banner::where('status', '1')->count() > 0) {
                $item = Banner::findOrFail($id);
                $item->status = !$item->status;
                $item->save();
                $log = new Log();
                $log->action = "A Banner activated / deactivated";
                $log->user_id = Auth::user()->id;
                $log->save();
                return redirect()->back()->with('successMsg', 'Banner Activated / Deactivated!');
            } else {
                return redirect()->back()->with('infoMsg', 'There must be one active slider!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $banner = Banner::find($id);
            $banner->delete();
            $log = new Log();
            $log->action = "A banner deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Slider Successfully Deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
