<?php

namespace App\Http\Controllers;

use App\Models\Transcation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TranscationController extends Controller
{
    /////////////////////////////////////////////////////
    /////////////////// sendMoneyIndex ///////////////////
    /////////////////////////////////////////////////////

    public function sendMoneyIndex(){

        return view('dashboard.pages.userPages.sendMoney.index');
    }

    ///sendMoney method start
    public function sendMoney(Request $request){



        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;
        $receiver = User::where('phone', $request->phone)
        ->where('role','user')
        ->get();
        // dd($receiver);

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance + (double) $request->balance * 0.05 <= Auth::user()->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            // dd($request->all());

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('user.sendMoney.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance - (double)$request->balance * 0.05;
                $vat = (double) $request->balance * 0.05;
                $transaction->vat = $vat;
                $transaction->payment_type = 'user to user';
                $transaction->save();

                $admin = User::find(Auth::user()->creator_id);
                $admin->balance = (double)$admin->balance + (double)$vat;
                $admin->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance - (double) $request->balance * 0.05;
                $sender->save();
                $receiver->balance =(double)$receiver->balance;  (double)$request->balance;
                $receiver->save();

                return back()->with(['messages' => 'Successfully Send Money']);

            }

        }

        else{

            return to_route('user.sendMoney.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///sendMoney method end

    /////////////////////////////////////////////////////
    /////////////////// cashOutIndex ///////////////////
    /////////////////////////////////////////////////////

    public function cashOutIndex(){

        return view('dashboard.pages.userPages.cashOut.index');
    }


    ///cashOut method start user to agent
    public function cashOut(Request $request){

        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;
        $receiver = User::where('phone', $request->phone)
        ->where('role','agent')
        ->get();

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance + (double) $request->balance * 0.05 <= Auth::user()->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('user.cashOut.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance - (double)$request->balance * 0.05;
                $vat = (double) $request->balance * 0.05;
                $transaction->vat = $vat;
                $transaction->payment_type = 'user to agent';
                $transaction->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance - (double) $request->balance * 0.05;
                $sender->save();
                $receiver->balance =(double)$receiver->balance + (double)$request->balance + (double) $request->balance * 0.05;
                $receiver->save();

                return to_route('user.cashOut.index')->with(['messages' => 'Successfully Cash Out']);

            }

        }

        else{

            return to_route('user.cashOut.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///cashOut method end

    /////////////////////////////////////////////////////
    /////////////////// agentBankIndex /////////////////
    /////////////////////////////////////////////////////

    public function agentBankIndex(){

        return view('dashboard.pages.agentPages.agentBank.index');
    }


    ///agentBank method start user to agent
    public function agentBank(Request $request){

        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;
        $receiver = User::where('phone', $request->phone)
        ->where('role','bank')
        ->get();

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance + (double) $request->balance * 0.03 <= Auth::user()->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('agent.agentBank.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance - (double)$request->balance * 0.03;
                $vat = (double) $request->balance * 0.03;
                $transaction->vat = $vat;
                $transaction->payment_type = 'agent to Bank';
                $transaction->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance - (double) $request->balance * 0.03;
                $sender->save();
                $receiver->balance =(double)$receiver->balance + (double)$request->balance + (double) $request->balance * 0.03;
                $receiver->save();

                return to_route('agent.agentBank.index')->with(['messages' => 'Successfully transfer agent to Bank']);

            }

        }

        else{

            return to_route('agent.agentBank.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///agentBank method end

    /////////////////////////////////////////////////////
    /////////////////// agentAdminindex /////////////////
    /////////////////////////////////////////////////////
    public function agentAdminindex(){

        return view('dashboard.pages.agentPages.agentAdmin.index');
    }


    ///agentAdmin method start user to agent
    public function agentAdmin(Request $request){

        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;
        $receiver = User::where('phone', $request->phone)
        ->where('role','admin')
        ->get();

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance + (double) $request->balance * 0.025 <= Auth::user()->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('agent.agentAdmin.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance - (double)$request->balance * 0.025;
                $vat = (double) $request->balance * 0.025;
                $transaction->vat = $vat;
                $transaction->payment_type = 'agent to admin';
                $transaction->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance - (double) $request->balance * 0.025;
                $sender->save();
                $receiver->balance =(double)$receiver->balance + (double)$request->balance + (double) $request->balance * 0.025;
                $receiver->save();

                return to_route('agent.agentAdmin.index')->with(['messages' => 'Successfully transfer agent to Admin']);

            }

        }

        else{

            return to_route('agent.agentAdmin.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///agentAdmin method end


    /////////////////////////////////////////////////////
    /////////////////// bankAdminindex /////////////////
    /////////////////////////////////////////////////////
    public function bankAdminindex(){

        return view('dashboard.pages.bankPages.bankAdmin.index');
    }


    ///bankAdmin method start user to agent
    public function bankAdmin(Request $request){

        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;
        $receiver = User::where('phone', $request->phone)
        ->where('role','admin')
        ->get();

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance + (double) $request->balance * 0.02 <= Auth::user()->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('bank.bankAdmin.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance - (double)$request->balance * 0.02;
                $vat = (double) $request->balance * 0.02;
                $transaction->vat = $vat;
                $transaction->payment_type = 'bank to admin';
                $transaction->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance - (double) $request->balance * 0.02;
                $sender->save();
                $receiver->balance =(double)$receiver->balance + (double)$request->balance + (double) $request->balance * 0.02;
                $receiver->save();

                return to_route('bank.bankAdmin.index')->with(['messages' => 'Successfully transfer Bank to Admin']);

            }

        }
        else{

            return to_route('bank.bankAdmin.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///bankAdmin method end


    /////////////////////////////////////////////////////
    /////////////////// distributeAgentIndex /////////////////
    /////////////////////////////////////////////////////
    public function distributeAgentIndex(){

        return view('dashboard.pages.adminPages.distributeAgent.index');
    }


    ///distributeAgent method start user to agent
    public function distributeAgent(Request $request){

        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;

        $receiver = User::where('phone', $request->phone)
        ->where('role','agent')
        ->get();

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('admin.distribute.agent.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance;
                $transaction->vat = 00.00;
                $transaction->payment_type = 'admin to agent';
                $transaction->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance;
                $sender->save();
                $receiver->balance =(double)$receiver->balance + (double)$request->balance;
                $receiver->save();

                return to_route('admin.distribute.agent.index')->with(['messages' => 'Successfully transfer Admin to Agent']);

            }

        }
        else{

            return to_route('admin.distribute.agent.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///distributeAgent method end
    /////////////////////////////////////////////////////
    /////////////////// distributeAgentIndex /////////////////
    /////////////////////////////////////////////////////
    public function distributeBankIndex(){

        return view('dashboard.pages.adminPages.distributeBank.index');
    }


    ///distributeAgent method start user to agent
    public function distributeBank(Request $request){

        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'balance' => 'required|numeric'
        ]);

        $sender_id = Auth::user()->id;

        $receiver = User::where('phone', $request->phone)
        ->where('role','bank')
        ->get();

        $transaction_id = uniqid().Auth::user()->id.time();

        if((double) $request->balance  && count($receiver) !=0 && Auth::user()->phone != $request->phone){

            if(!Hash::check($request->password , Auth::user()->password)){
                return to_route('admin.distribute.bank.index')->with(['message' => 'There are somthing Wrong']);
            }

            else{

                $sender = User::find($sender_id);
                $transaction = new Transcation();

                $transaction->sender_id = $sender_id;
                foreach($receiver as $receiver){
                    $transaction->receiver_id = $receiver->id;
                }
                $transaction->transaction_id = $transaction_id;
                $transaction->previous_amount = Auth::user()->balance;
                $transaction->transfer_amount = $request->balance;
                $transaction->after_amount = (double)$sender->balance - (double)$request->balance;
                $transaction->vat = 00.00;
                $transaction->payment_type = 'admin to bank';
                $transaction->save();

                $sender->balance = (double)$sender->balance - (double)$request->balance;
                $sender->save();
                $receiver->balance =(double)$receiver->balance + (double)$request->balance;
                $receiver->save();

                return to_route('admin.distribute.bank.index')->with(['messages' => 'Successfully transfer Admin to Agent']);

            }

        }
        else{

            return to_route('admin.distribute.bank.index')->with(['message' => 'There are somthing Wrong']);
        }


    }

    ///distributeAgent method end


}
