<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MultiTypeUserController extends Controller
{
    ////
    public function index(){

        $role = UserRoleEnum::cases();

        // dd($role);

        return view('dashboard.pages.adminPages.createUser.index', compact('role'));
    }

    ////
    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:4|max:30',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|min:6|max:20'
        ]);

        // dd($request->role);
        if($request->role == 'admin' || $request->role == 'agent'|| $request->role == 'user' || $request->role == 'bank' ){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->status = '1';
            $user->creator_id = Auth::user()->id;
            $user->balance = $request->balance;
            $user->creator_id = Auth::user()->id;
            $user->password = Hash::make($request->password);
            $user->save();
            return to_route('admin.create.user.show')->with(['message', 'Successfully Created!']);
        }
        else{
            return to_route('admin.create.user.index')->with(['messages' => 'Please Select a User Type!']);
        }

    }


    public function show(){
        $users = User::where('role', '!=', 'admin')->paginate(3);
        return view('dashboard.pages.adminPages.createUser.show', compact('users'));
    }
}
