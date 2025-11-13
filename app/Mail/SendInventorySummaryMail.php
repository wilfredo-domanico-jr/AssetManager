<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInventorySummaryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject('Inventory Summary Report')
            ->view('emails.inventory-summary')
            ->attach($this->filePath, [
                'as' => 'inventory_summary.csv',
                'mime' => 'text/csv',
            ]);
    }
}
