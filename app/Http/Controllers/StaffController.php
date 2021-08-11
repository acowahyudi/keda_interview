<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\TypeMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function indexAllChat()
    {
        if (Auth::user()->user_type_id==2){
            $messages = Message::orderByDesc('created_at')
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Data chat retrieved successfully',
                'data' => $messages
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ],401);
        }

    }

    public function indexOwnChat()
    {
        if (Auth::user()->user_type_id==2){
            $messages = Message::where('receive_id',Auth::id())
                ->orWhere('sender_id',Auth::id())
                ->with(['receiveUser','senderUser'])
                ->orderByDesc('created_at')
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Data chat retrieved successfully',
                'data' => $messages
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ],401);
        }
    }

    public function indexCustomer()
    {
        if (Auth::user()->user_type_id==2){
            $customer = User::where('user_type_id',1)->withTrashed()->get();
            return response()->json([
                'success' => true,
                'message' => 'Data customer retrieved successfully',
                'data' => $customer
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ],401);
        }
    }

    public function chatToStaffOrCustomer(Request $request)
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

    public function deleteCustomer($id)
    {
        if (Auth::user()->user_type_id==2){
            $customer = User::find($id);
            if (empty($customer)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found',
                    'error_code' => 404
                ], 404);
            }
            if ($customer->user_type_id==1){
                $customer->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Customer deleted successfully',
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'User is not Customer',
                    'error_code' => 406
                ], 406);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ],401);
        }
    }

}
