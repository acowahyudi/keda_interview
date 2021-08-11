<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\TypeMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function indexChat()
    {
        $messages = Message::where('sender_id',Auth::id())
            ->orWhere('receive_id',Auth::id())
            ->with(['receiveUser','senderUser'])
            ->orderByDesc('created_at')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data chat retrieved successfully',
            'data' => $messages
        ]);
    }

    public function chatToCustomer(Request $request)
    {
        $input = $request->all();
        $typeMessage = TypeMessage::find(1);

        $input['sender_id'] = Auth::id();
        $input['type_message_id'] = $typeMessage->id;

        try{
            $messages = Message::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Chat sent successfully',
                'data' => $messages->load('receiveUser','typeMessage')
            ],201);

        }catch (\Exception $error){
            return response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'error_code' => $error->getCode()
            ]);
        }


    }

    public function reportToStaff(Request $request)
    {
        $input = $request->all();
        $typeMessage = TypeMessage::find(2);

        $input['sender_id'] = Auth::id();
        $input['type_message_id'] = $typeMessage->id;

        try{
            $messages = Message::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Report sent successfully',
                'data' => $messages->load('receiveUser','typeMessage')
            ],201);

        }catch (\Exception $error){
            return response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'error_code' => $error->getCode()
            ]);
        }


    }

    public function feedbackToStaff(Request $request)
    {
        $input = $request->all();
        $typeMessage = TypeMessage::find(3);

        $input['sender_id'] = Auth::id();
        $input['type_message_id'] = $typeMessage->id;

        try{
            $messages = Message::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Feedback sent successfully',
                'data' => $messages->load('receiveUser','typeMessage')
            ],201);

        }catch (\Exception $error){
            return response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'error_code' => $error->getCode()
            ]);
        }


    }
}
