<?php

namespace App\Http\Controllers;

use App\Models\Transcation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function transaction(){

        $transactions = Transcation::paginate(8);

        return view('dashboard.pages.adminPages.transaction.transaction', compact('transactions'));
    }

    public function makeActive($id){
        $user = User::find($id);
        $user->status = '1';
        $user->creator_id = Auth::user()->id;
        $user->update();
        return to_route('admin.create.user.show');
    }
    public function makeInactive($id){
        $user = User::find($id);
        $user->status = '0';
        $user->creator_id = '0';
        $user->update();
        return to_route('admin.create.user.show');
    }

}
