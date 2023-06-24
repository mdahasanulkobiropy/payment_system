@extends('dashboard.master.master')

    @section('content')
        <div class="card">
            <div class="card-header">
                <h3>All Transaction List:</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Sl</th>
                        <th>Sender</th>
                        <th>Sender Number</th>
                        <th>Transaction Id</th>
                        <th>Transfer Amount</th>
                        <th>Payment Type</th>
                        <th>Previous Amount</th>
                        <th>After Amount</th>
                        <th>Receiver</th>
                        <th>Receiver Number</th>
                        <th>Vat</th>
                        <th>Transfer Time</th>
                    </tr>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$transaction->getSenderDetails->name}}</td>
                            <td>{{$transaction->getSenderDetails->phone}}</td>
                            <td>{{$transaction->transaction_id}}</td>
                            <td>{{$transaction->transfer_amount}}</td>
                            <td>{{$transaction->payment_type}}</td>
                            <td>{{$transaction->previous_amount}}</td>
                            <td>{{$transaction->after_amount}}</td>
                            <td>{{$transaction->getReceiverDetails->name}}</td>
                            <td>{{$transaction->getReceiverDetails->phone}}</td>
                            <td>{{$transaction->vat}}</td>
                            <td>{{$transaction->created_at}}</td>
                        </tr>
                    @empty

                    @endforelse
                </table>
                {{$transactions->links()}}
            </div>
        </div>
    @endsection
