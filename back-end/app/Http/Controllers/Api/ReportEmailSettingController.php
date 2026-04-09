<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\ReportEmail;
use Illuminate\Http\Request;

class ReportEmailSettingController extends Controller
{

    public function index()
    {
        $emails = ReportEmail::pluck('email');

        return response()->json([
            'emails' => $emails
        ], 200);
    }

    public function store(Request $request)
    {
        // Validate that the field is not empty
        $request->validate([
            'emails' => 'required|string',
        ]);

        // Split by comma and trim spaces
        $emails = array_map('trim', explode(',', $request->emails));

        // Validate each email
        foreach ($emails as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'message' => "Invalid email address detected: $email"
                ], 422);
            }
        }

        ReportEmail::truncate(); // remove existing rows
        foreach ($emails as $email) {
            ReportEmail::create(['email' => $email]);
        }

        return response()->json([
            'message' => 'Emails updated successfully!'
        ], 200);
    }
}
