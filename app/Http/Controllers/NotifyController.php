<?php

namespace App\Http\Controllers;

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

        return response()->json([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'message' => $request->input('message'),
        ], 200);
    }
}
