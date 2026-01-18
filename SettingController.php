<?php

namespace App\Http\Controllers;

use App\Models\HeadMessage;
use App\Models\Log;
use App\Models\Setting;
use App\Models\User;
use App\Models\Visibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setting_access', ['only' => ['site', 'show', 'general', 'setAm', 'setEn', 'setOr', 'setHeadMessage', 'contact', 'password', 'update', 'changepassword']]);
        $this->middleware('permission:setting_create', ['only' => ['general', 'setAm', 'setEn', 'setOr', 'setHeadMessage', 'contact']]);
        $this->middleware('permission:setting_edit', ['only' => ['general', 'setAm', 'setEn', 'setOr', 'setHeadMessage', 'contact']]);
        $this->middleware('permission:setting_delete', ['only' => ['general', 'setAm', 'setEn', 'setOr', 'setHeadMessage', 'contact']]);
    }

    public function site()
    {
        try {
            $setting = Setting::find(1);
            $visible = Visibility::find(1);
            $head_message = HeadMessage::find(1);
            return view('admin.setting.index', compact('setting', 'head_message', 'visible'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function show()
    {
        try {
            $user = User::find(Auth::user()->id);
            return view('admin.setting.profile')->with('user', $user);
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }


    public function general(Request $request)
    {
        try {
            $this->validate($request, [
                'siteTitle' => 'required',
                'SiteMoto' => 'required',
                'logo_transparent' => 'nullable|mimes:jpeg,jpg,bmp,png,svg',
                'logo_white' => 'nullable|mimes:jpeg,jpg,bmp,png,svg',
                'logo_footer' => 'nullable|mimes:jpeg,jpg,bmp,png,svg',
                'favicon' => 'nullable|mimes:jpeg,jpg,bmp,png,svg',
                'keywords' => 'required',
                'sitedescription' => 'required',
                'no_doctors' => 'required',
                'no_services' => 'required',
                 'no_departments' => 'required',
                'no_awards' => 'required',
            ]);
            $setting = Setting::find(1);
            $image1 = $request->file('logo_transparent');
            $image2 = $request->file('logo_white');
            $image3 = $request->file('logo_footer');
            $image4 = $request->file('favicon');
            $slug = Str::slug($request->siteTitle);
            if ($request->hasFile('logo_transparent')) {
                if (isset($image1)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename1 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image1->getClientOriginalExtension();

                    if (!file_exists('uploads/Setting')) {
                        mkdir('uploads/Setting', 0777, true);
                    }
                    $image1->move('uploads/Setting', $imagename1);
                    $setting->logo_transparent = $imagename1;
                } else {
                    $imagename1 = "logo_transparent.png";
                }
            }
            if ($request->hasFile('logo_white')) {
                if (isset($image2)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename2 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image2->getClientOriginalExtension();

                    if (!file_exists('uploads/Setting')) {
                        mkdir('uploads/Setting', 0777, true);
                    }
                    $image2->move('uploads/Setting', $imagename2);
                    $setting->logo_white = $imagename2;
                } else {
                    $imagename2 = "logo_white.png";
                }
            }
            if ($request->hasFile('logo_footer')) {
                if (isset($image3)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename3 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image3->getClientOriginalExtension();

                    if (!file_exists('uploads/Setting')) {
                        mkdir('uploads/Setting', 0777, true);
                    }
                    $image3->move('uploads/Setting', $imagename3);
                    $setting->logo_footer = $imagename3;
                } else {
                    $imagename3 = "logo_footer.png";
                }
            }
            if ($request->hasFile('favicon')) {
                if (isset($image4)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename4 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image4->getClientOriginalExtension();

                    if (!file_exists('uploads/Setting')) {
                        mkdir('uploads/Setting', 0777, true);
                    }
                    $image4->move('uploads/Setting', $imagename4);
                    $setting->favicon = $imagename4;
                } else {
                    $imagename4 = "favicon.png";
                }
            }

            // //////////////////

            /////////////////////////

            /////////////////////

            $setting->siteTitle = $request->siteTitle;
            $setting->SiteMoto = $request->SiteMoto;
            $setting->keywords = $request->keywords;
            $setting->sitedescription = $request->sitedescription;
            $setting->no_doctors = $request->no_doctors;
            $setting->no_services = $request->no_services;
            $setting->no_departments = $request->no_departments;
            $setting->no_awards = $request->no_awards;
            $setting->save();
            $log = new Log();
            $log->action = "General site setting changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'General Settings Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function setAm(Request $request)
    {
        try {
            $this->validate($request, [
                'footer_note_am' => 'required',
                'contact_note_am' => 'required',
                'about_note_am' => 'required',
                'vision_am' => 'required',
                'mission_am' => 'required',
                'objectives_am' => 'required',
                'values_am' => 'required',
                'focuses_am' => 'required',
            ]);
            $setting = Setting::find(1);
            $setting->footer_note_am = $request->footer_note_am;
            $setting->contact_note_am = $request->contact_note_am;
            $setting->about_note_am = $request->about_note_am;
            $setting->vision_am = $request->vision_am;
            $setting->mission_am = $request->mission_am;
            $setting->objectives_am = $request->objectives_am;
            $setting->values_am = $request->values_am;
            $setting->focuses_am = $request->focuses_am;
            $setting->save();
            $log = new Log();
            $log->action = "Amharic setting changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Amharic Settings Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function setEn(Request $request)
    {
        try {
            $this->validate($request, [
                'footer_note' => 'required',
                'contact_note' => 'required',
                'about_note' => 'required',
                'vision' => 'required',
                'mission' => 'required',
                'objectives' => 'required',
                'values' => 'required',
                'focuses' => 'required',
            ]);
            $setting = Setting::find(1);
            $setting->footer_note = $request->footer_note;
            $setting->contact_note = $request->contact_note;
            $setting->about_note = $request->about_note;
            $setting->about_image = $request->about_image;
            $setting->vision = $request->vision;
            $setting->mission = $request->mission;
            $setting->objectives = $request->objectives;
            $setting->values = $request->values;
            $setting->focuses = $request->focuses;
            $setting->save();
            $log = new Log();
            $log->action = "Site setting changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'English Settings Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function setOr(Request $request)
    {
        try {
            $this->validate($request, [
                'footer_note_or' => 'required',
                'contact_note_or' => 'required',
                'about_note_or' => 'required',
                'vision_or' => 'required',
                'mission_or' => 'required',
                'objectives_or' => 'required',
                'values_or' => 'required',
                'focuses_or' => 'required',
            ]);
            $setting = Setting::find(1);
            $setting->footer_note_or = $request->footer_note_or;
            $setting->contact_note_or = $request->contact_note_or;
            $setting->about_note_or = $request->about_note_or;
            $setting->vision_or = $request->vision_or;
            $setting->mission_or = $request->mission_or;
            $setting->objectives_or = $request->objectives_or;
            $setting->values_or = $request->values_or;
            $setting->focuses_or = $request->focuses_or;
            $setting->save();
            $log = new Log();
            $log->action = "Site setting changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Oromic Settings Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function setHeadMessage(Request $request)
    {
        try {
            $this->validate($request, [
                'full_name' => 'required',
                'full_name_am' => 'required',
                'full_name_or' => 'required',
                'message' => 'required',
                'message_am' => 'required',
                'message_or' => 'required',
                'intro' => 'required',
                'intro_am' => 'required',
                'intro_or' => 'required',
                'photo' => 'nullable|mimes:jpeg,jpg,bmp,png,svg',
            ]);
            $setting = HeadMessage::find(1);
            $setting->full_name = $request->full_name;
            $setting->full_name_am = $request->full_name_am;
            $setting->full_name_or = $request->full_name_or;
            $setting->message = $request->message;
            $setting->message_am = $request->message_am;
            $setting->message_or = $request->message_or;
            $setting->intro = $request->intro;
            $setting->intro_am = $request->intro_am;
            $setting->intro_or = $request->intro_or;
            $slug = Str::slug($request->full_name);
            $image4 = $request->file('photo');
            if ($request->hasFile('photo')) {

                if (isset($image4)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename4 = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image4->getClientOriginalExtension();

                    if (!file_exists('uploads/Head')) {
                        mkdir('uploads/Head', 0777, true);
                    }
                    $image4->move('uploads/Head', $imagename4);
                    $setting->photo = $imagename4;
                } else {
                    $imagename4 = "favicon.png";
                }
            }
            $setting->save();
            $log = new Log();
            $log->action = "Head Information changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Head Message Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function contact(Request $request)
    {
        try {
            $this->validate($request, [
                'phone' => 'required',
                'emailNoReply' => 'required',
                'emailInfo' => 'required',
                'google_map' => 'required',
                // 'about_us' => 'required',
                'facebook' => 'required',
                'instagram' => 'required',
                'youtube' => 'required',
                'telegram' => 'required',
                'twitter' => 'required',
                'whatsapp' => 'required',
            ]);
            $setting = Setting::find(1);
            $setting->phone = $request->phone;
            $setting->emailNoReply = $request->emailNoReply;
            $setting->emailInfo = $request->emailInfo;
            $setting->google_map = $request->google_map;
            $setting->about_us = $request->about_us;
            $setting->facebook = $request->facebook;
            $setting->instagram = $request->instagram;
            $setting->youtube = $request->youtube;
            $setting->telegram = $request->telegram;
            $setting->twitter = $request->twitter;
            $setting->whatsapp = $request->whatsapp;
            $setting->save();
            $log = new Log();
            $log->action = "Contact setting changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'Contact Settings Successfully Updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function password()
    {
        try {
            $user = User::find(Auth::user()->id);
            return view('admin.setting.changepassword')->with('user', $user);
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function homesetting(Request $request)
    {
        // dd($request->input('home_counters'));
        // try {
        $home_counters = '0';
        $home_departments = '0';
        $home_directorates = '0';
        $home_events = '0';
        $home_services = '0';
        $home_head = '0';
        $home_testimony = '0';
        $home_news = '0';
        $home_popup = '0';
        $home_gallery = '0';
        $home_mission = '0';
        $home_app = '0';
        $home_address = '0';

        if ($request->has('home_counters')) {
            $home_counters = '1';
        }
        if ($request->has('home_departments')) {
            $home_departments = '1';
        }
        if ($request->has('home_directorates')) {
            $home_directorates = '1';
        }
        if ($request->has('home_events')) {
            $home_events = '1';
        }
        if ($request->has('home_services')) {
            $home_services = '1';
        }
        if ($request->has('home_head')) {
            $home_head = '1';
        }
        if ($request->has('home_testimony')) {
            $home_testimony = '1';
        }
        if ($request->has('home_news')) {
            $home_news = '1';
        }
        if ($request->has('home_popup')) {
            $home_popup = '1';
        }
        if ($request->has('home_gallery')) {
            $home_gallery = '1';
        }
        if ($request->has('home_mission')) {
            $home_mission = '1';
        }
        if ($request->has('home_app')) {
            $home_app = '1';
        }
        if ($request->has('home_address')) {
            $home_address = '1';
        }

        $visible = Visibility::find(1);
        $visible->home_counters = $home_counters;
        $visible->home_departments = $home_departments;
        $visible->home_directorates = $home_directorates;
        $visible->home_events = $home_events;
        $visible->home_services = $home_services;
        $visible->home_head = $home_head;
        $visible->home_testimony = $home_testimony;
        $visible->home_news = $home_news;
        $visible->home_popup = $home_popup;
        $visible->home_gallery = $home_gallery;
        $visible->home_mission = $home_mission;
        $visible->home_app = $home_app;
        $visible->home_address = $home_address;
        $visible->save();
        $log = new Log();
        $log->action = "Homepage settings changed";
        $log->user_id = Auth::user()->id;
        $log->save();
        return redirect()->back()->with('successMsg', 'Contact Settings Successfully Updated!');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('infoMsg', $th->getMessage());
        // }
    }
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => 'unique:users,email,' . $user->id,
            ]);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->save();
            return redirect()->back()->with('successMsg', 'Profile Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function changepassword(Request $request)
    {
        try {
            $user = Auth::user();

            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with('errorMsg', 'Your current password does not matches with the password you provided. Please try again.');
            }

            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with('errorMsg', 'New Password cannot be same as your current password. Please choose a different password.');
            }

            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with('successMsg', 'Password Changed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
