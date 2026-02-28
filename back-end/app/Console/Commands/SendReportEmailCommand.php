<?php

namespace App\Console\Commands;

use App\Mail\SendInventorySummaryMail;
use App\Models\ReportEmail;
use App\Exports\InventorySummaryCsvExport;
use App\Exports\DepreciationSummaryCsvExport;
use App\Exports\LifeCycleSummaryCsvExport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendReportEmailCommand extends Command
{
    protected $signature = 'emailSending:send-report-summary';
    protected $description = 'Send inventory summary report, depreciation and lifecycle report to configured emails';

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

        // Generate unique filenames
        $timestamp = now()->format('Y_m_d_His');

        $inventorySummaryFile = "inventory_summary_{$timestamp}.csv";
        $depreciationSummaryFile = "depreciation_summary_{$timestamp}.csv";
        $lifecycleSummaryFile = "lifecycle_summary_{$timestamp}.csv";

        // Paths to store
        $inventorySummaryFilePath = "generated_reports/{$inventorySummaryFile}";
        $depreciationSummaryFilePath = "generated_reports/{$depreciationSummaryFile}";
        $lifecycleSummaryFilePath = "generated_reports/{$lifecycleSummaryFile}";
        // Generate CSV files
        Excel::store(new InventorySummaryCsvExport, $inventorySummaryFilePath, 'public');
        Excel::store(new DepreciationSummaryCsvExport, $depreciationSummaryFilePath, 'public');
        Excel::store(new LifeCycleSummaryCsvExport, $lifecycleSummaryFilePath, 'public');

        // Full storage paths
        $inventorySummary = storage_path("app/public/{$inventorySummaryFilePath}");
        $depreciationSummary = storage_path("app/public/{$depreciationSummaryFilePath}");
        $lifecycleSummary = storage_path("app/public/{$lifecycleSummaryFilePath}");

        // Safety checks
        if (!file_exists($inventorySummary)) {
            $this->error("CSV file not found at: {$inventorySummary}");
            return Command::FAILURE;
        }

        if (!file_exists($depreciationSummary)) {
            $this->error("CSV file not found at: {$depreciationSummary}");
            return Command::FAILURE;
        }

        if (!file_exists($lifecycleSummary)) {
            $this->error("CSV file not found at: {$lifecycleSummary}");
            return Command::FAILURE;
        }

        // Send email to each recipient
        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(
                    new SendInventorySummaryMail([$inventorySummary, $depreciationSummary, $lifecycleSummary])
                );

                $this->info("Report sent to: {$email}");
            } catch (\Exception $e) {
                $this->error("Failed to send to {$email}: {$e->getMessage()}");
            }
        }

        $this->info('Report email(s) sent successfully.');
        return Command::SUCCESS;
    }
}
