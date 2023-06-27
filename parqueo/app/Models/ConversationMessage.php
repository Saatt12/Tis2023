<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    use HasFactory;
    protected $fillable =[
        'message',
        'type',
        'sender_id',
        'receiver_id',
        'conversation_id',
    ];
    public function sender()
    {
        return $this->belongsTo('App\Models\User','sender_id', 'id');
    }
    public function receiver()
    {
        return $this->belongsTo('App\Models\User','receiver_id', 'id');
    }
}
