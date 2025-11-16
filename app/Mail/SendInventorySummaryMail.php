<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInventorySummaryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $files; // Array of file paths

    /**
     * Create a new message instance.
     *
     * @param array $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Asset Manager Reports')
            ->view('emails.email-summary');

        // Attach each file individually
        foreach ($this->files as $filePath) {
            // Use the actual filename from the path
            $fileName = basename($filePath);

            $email->attach($filePath, [
                'as' => $fileName,
                'mime' => 'text/csv',
            ]);
        }

        return $email;
    }
}
