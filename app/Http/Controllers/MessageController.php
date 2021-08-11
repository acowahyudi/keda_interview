<?php

namespace App\Http\Controllers;

use App\Models\TypeMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function listTypeMessage()
    {
        $typeMessages = TypeMessage::all();
        return response()->json([
            'success' => true,
            'data' => $typeMessages
        ]);
    }
}
