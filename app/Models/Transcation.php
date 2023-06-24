<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getSenderDetails(){
       return $this->belongsTo(User::class, 'sender_id', 'id');
    }
    public function getReceiverDetails(){
       return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
