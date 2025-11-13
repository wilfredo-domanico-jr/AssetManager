<?php


namespace App\Http\Controllers;

use App\Models\ReportEmail;
use Illuminate\Http\Request;

class ReportEmailSettingController extends Controller
{
    public function index()
    {
        $emails = ReportEmail::pluck('email')->implode(', ');
        return view('report-email-setting.index', compact('emails'));
    }

    public function update(Request $request)
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
                return back()
                    ->withInput()
                    ->withErrors(['emails' => "Invalid email address detected: $email"]);
            }
        }

        // ✅ Optional: Save to database (clear old and insert new)
        ReportEmail::truncate(); // remove existing rows
        foreach ($emails as $email) {
            ReportEmail::create(['email' => $email]);
        }

        return redirect()
            ->route('admin.report-email-setting.index')
            ->with('success', 'Emails updated successfully!');
    }
}
