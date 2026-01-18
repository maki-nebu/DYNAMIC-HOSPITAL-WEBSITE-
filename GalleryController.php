<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Log;
use App\Testimony;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:gallery_access', ['only' => ['index']]);
        $this->middleware('permission:gallery_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery_delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        try {
            $galleries = Gallery::orderByDesc('updated_at')->get();
            return view('admin.gallery.index', compact('galleries'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function create()
    {
        try {
            return view('admin.gallery.create');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,gif|max:2048', // Adjust the maximum file size as needed
            ]);

            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();

            $image->move(public_path('uploads/Gallery'), $imageName);
            $imageUpload = new Gallery();
            $imageUpload->image = $imageName;
            $imageUpload->save();
            
            $log = new Log();
            $log->action = "A gallery added";
            $log->user_id = Auth::user()->id;
            $log->save();

            return response()->json(['success' => $imageName, 'message' => 'Image uploaded successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $gallery = Gallery::find($id);
            $gallery->delete();
            $log = new Log();
            $log->action = "A gallery deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Gallery Successfully Deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
