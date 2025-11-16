<?php

namespace App\Console\Commands;

use App\Mail\SendInventorySummaryMail;
use App\Models\ReportEmail;
use App\Exports\InventorySummaryCsvExport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendInventorySummaryCommand extends Command
{
    protected $signature = 'emailSending:send-inventory-summary';
    protected $description = 'Send inventory summary report to configured emails';

    public function handle()
    {
        // Get all configured recipient emails
        $emails = ReportEmail::pluck('email')->filter()->toArray();

        if (empty($emails)) {
            $this->info('No recipient emails configured.');
            return Command::SUCCESS;
        }

        // Ensure the public/generated_reports folder exists
        $publicDir = public_path('generated_reports');
        if (!is_dir($publicDir)) {
            mkdir($publicDir, 0777, true);
        }

        // Generate file name and paths
        $fileName = 'inventory_summary_' . now()->format('Y_m_d_His') . '.csv';
        $relativePath = 'generated_reports/' . $fileName;                   // Relative to public for URL

        // Generate CSV in public/generated_reports
        Excel::store(new InventorySummaryCsvExport, $relativePath, 'public'); // 'public' disk
        $filePath = storage_path('app/public/' . $relativePath); // attach to mail
        // Safety check: file exists before sending
        if (!file_exists($filePath)) {
            $this->error("CSV file not found at: {$filePath}");
            return Command::FAILURE;
        }

        // Send email to each recipient
        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new SendInventorySummaryMail($filePath));
                $this->info("Report sent to: {$email}");
            } catch (\Exception $e) {
                $this->error("Failed to send to {$email}: {$e->getMessage()}");
            }
        }

        $this->info('Inventory summary email(s) sent successfully.');
        return Command::SUCCESS;
    }
}
