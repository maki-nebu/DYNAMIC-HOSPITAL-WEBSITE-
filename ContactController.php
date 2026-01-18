<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Log;
use App\Models\Testimony;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:contact_access', ['only' => ['index', 'show']]);
        $this->middleware('permission:contact_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact_delete', ['only' => ['destroy']]);
    }
    
    
    public function index()
    {
        try {
            $contacts = Contact::orderByDesc('created_at')->get();
            return view('admin.contact.index', compact('contacts'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function show(Request $request, $id)
    {
        try {
            $contact = Contact::find($id);
            return view('admin.contact.show', compact('contact'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => ['required', new ReCaptcha]
            ]);

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
            toast('Thank you for your message! we will contact you soon!', 'success');


            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function testimony(Request $request)
    {
        try {
            $this->validate($request, [
                'fullname' => 'required',
                'content' => 'required',
                'title' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            ]);
            try {
                $image = $request->file('image');
                $slug = Str::slug($request->title);
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

                $testimony = new Testimony();
                $testimony->fullname = $request->fullname;
                $testimony->content = $request->content;
                $testimony->title = $request->title;
                $testimony->image = $imagename;
                $testimony->content = $request->content;
                $testimony->is_enabled = 0;
                $testimony->save();
                toast('Thank you for your testimony! we will contact you soon!', 'success');
                return redirect()->back();
            } catch (\Throwable $th) {

                toast('Something Went wrong! Please try again.', 'warning');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $contact = Contact::find($id);
            $contact->delete();
            $log = new Log();
            $log->action = "A contact information deleted";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Contact successfully Deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function subscribe(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required',
                'g-recaptcha-response' => ['required', new ReCaptcha]
            ]);

            $contact = new Contact();
            $contact->name = "Subscription";
            $contact->email = $request->email;
            $contact->phone = "Subscription";
            $contact->message = "Subscription";
            $contact->save();
            toast('Thank you for your subscription!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th, 'error');
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
