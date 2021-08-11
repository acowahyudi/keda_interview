<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMessage extends Model
{
    use HasFactory;
    protected $table = 'type_messages';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable=[
        'type_message'
    ];

    public function message()
    {
        return $this->hasMany(\App\Models\Message::class, 'type_message_id');
    }

}
