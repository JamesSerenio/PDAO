<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submitInquiry(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        $record = ContactMessage::create([
            'type' => 'inquiry',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'category' => null,
            'message' => $validated['message'],
        ]);

        $this->sendNotificationEmail([
            'type' => 'Inquiry',
            'name' => $record->name,
            'email' => $record->email,
            'subject' => $record->subject,
            'category' => null,
            'message' => $record->message,
        ]);

        return back()->with('success', 'Your inquiry has been submitted successfully.');
    }

    public function submitFeedback(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        $record = ContactMessage::create([
            'type' => 'feedback',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => null,
            'category' => $validated['category'],
            'message' => $validated['message'],
        ]);

        $this->sendNotificationEmail([
            'type' => 'Feedback',
            'name' => $record->name,
            'email' => $record->email,
            'subject' => null,
            'category' => $record->category,
            'message' => $record->message,
        ]);

        return back()->with('success', 'Your feedback has been submitted successfully.');
    }

    private function sendNotificationEmail(array $data): void
    {
        $recipient = env('PDAO_CONTACT_EMAIL', env('MAIL_FROM_ADDRESS'));

        if (!$recipient) {
            return;
        }

        try {
            Mail::raw($this->buildEmailBody($data), function ($message) use ($recipient, $data) {
                $message->to($recipient)
                    ->subject('New ' . $data['type'] . ' from e-PDAO Connect');
            });
        } catch (\Throwable $e) {
            // Keep form submission working even if email fails
            report($e);
        }
    }

    private function buildEmailBody(array $data): string
    {
        return
            "Type: {$data['type']}\n" .
            "Name: {$data['name']}\n" .
            "Email: {$data['email']}\n" .
            "Subject: " . ($data['subject'] ?? 'N/A') . "\n" .
            "Category: " . ($data['category'] ?? 'N/A') . "\n\n" .
            "Message:\n{$data['message']}\n";
    }
}