<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class NotifyController extends Controller
{
    /**
     * Handle the notify POST request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function notify(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'message' => 'required|string|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Save to database
        $notification = Notification::create([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'id' => $notification->id,
            'from' => $notification->from,
            'to' => $notification->to,
            'message' => $notification->message,
            'created_at' => $notification->created_at,
            'updated_at' => $notification->updated_at,
        ], 200);
    }

    /**
     * Display a listing of notifications
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        
        return view('notifications.index', compact('notifications'));
    }
}
