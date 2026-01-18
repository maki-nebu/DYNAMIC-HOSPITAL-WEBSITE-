<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

        public function __construct()
    {
        $this->middleware('permission:user_access', ['only' => ['index', 'show']]);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_delete', ['only' => ['destroy']]);
    }

    use SoftDeletes;

    public function index()
    {
        try {
            $users = User::orderByDesc('updated_at')->get();
            return view('admin.user.index', compact('users'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $roles = Role::all();
            return view('admin.user.edit', compact('user', 'roles'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function create()
    {
        $roles = Role::pluck('name');
        try {
            return view('admin.user.create', compact('roles'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public static function VerifyPhone($phone)
    {
        if (!empty($phone) && $phone != null) {
            $pattern_1 = "/^(\+251[9]{1}[0-9]{8})$/";
            $pattern_2 = "/^(09[0-9]{8})$/";
            $pattern_3 = "/^(9[0-9]{8})$/";
            $pattern_4 = "0000000000";
            $pattern_5 = "/^(\+1[0-9]{10})$/";
            if (preg_match($pattern_2, $phone)) {
                return "+251" . substr($phone, 1);
            } else if (preg_match($pattern_3, $phone)) {
                return "+251" . $phone;
            } else if ($phone == $pattern_4) {
                return $phone;
            } else return $phone;
        } else return null;
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => array('required', 'regex:/^(\+?251|0)?9(\d\d\d\d\d\d\d\d)$/u', 'unique:users', 'min:10'),
            ]);


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->assignRole($request->input('role'));
            $user->password = Hash::make($request->password);
            $user->save();

            $log = new Log();
            $log->action = "A new user created";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->route('admin.users')->with('successMsg', 'User\'s registered!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|string|email|unique:users,email,' . $id,
                'phone' => 'required|numeric|unique:users,phone,' . $id,
            ]);


            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();

            // $user->roles()->attach($request->roles);
            // $item->ingredients()->attach($request->ingredients);
            $log = new Log();
            $log->action = "A user infromation upated";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->route('admin.users')->with('successMsg', 'User\'s Info Successfully updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function admin($id)
    {
        try {
            $user = User::find($id);

            if ($user->role == 'admin') {
                $user->role = 'user';
            } else {
                $user->role = 'admin';
            }
            $user->save();
            $log = new Log();
            $log->action = "A user's role changed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'User\'s Role Successfully updated!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function onlyTrashed()
    {
        try {
            $users = User::onlyTrashed()->get();
            return view('admin.post.index', compact('users'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            $log = new Log();
            $log->action = "A user trashed";
            $log->user_id = Auth::user()->id;
            $log->save();
            return redirect()->back()->with('successMsg', 'User successfully Deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function trashed()
    {
        try {
            $users = User::onlyTrashed()->get();
            return view('admin.user.trashed')->with('users', $users);
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
