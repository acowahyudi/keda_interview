<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'receive_id',
        'sender_id',
        'user_reported_id',
        'type_message_id',
        'text'
    ];

    protected $casts = [
        'receive_id' => 'integer',
        'sender_id'=> 'integer',
        'user_reported_id' => 'integer',
        'type_message_id' => 'integer',
        'text' => 'string'
    ];

    public static $rules = [
        'receive_id' => 'required|integer',
        'sender_id'=> 'required|integer',
        'user_reported_id' => 'nullable',
        'type_message_id' => 'required|integer',
        'text' => 'string'
    ];

    public function typeMessage()
    {
        return $this->belongsTo(\App\Models\UserType::class, 'type_message_id');
    }
    public function senderUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'sender_id');
    }
    public function receiveUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'receive_id');
    }
    public function userReported()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_reported_id');
    }
}
