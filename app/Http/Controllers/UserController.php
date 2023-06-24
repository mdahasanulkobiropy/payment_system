<?php

namespace App\Http\Controllers;

use App\Models\Transcation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    ////user
    public function myTransctionUser(){


        $transactions = Transcation::where('sender_id', Auth::user()->id)->paginate(3);

        return view('dashboard.pages.userPages.myTransaction.index', compact('transactions'));

    }


    ///bank
    public function myTransctionBank(){

        $transactions = Transcation::where('sender_id', Auth::user()->id)->paginate(3);

        return view('dashboard.pages.bankPages.myTransaction.index', compact('transactions'));
    }


    /////agent
    public function myTransctionAgent(){

        $transactions = Transcation::where('sender_id', Auth::user()->id)->paginate(3);

        return view('dashboard.pages.agentPages.myTransaction.index', compact('transactions'));

    }
}
