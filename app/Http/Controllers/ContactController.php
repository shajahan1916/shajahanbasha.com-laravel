<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    /**
     * Receive an enquiry from the contact slide.
     *
     * The form posts over fetch() so the visitor keeps their place in the
     * slider, but a plain POST (no JS) is handled too.
     */
    public function store(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $data = [
            'name'    => $request->string('name')->trim()->value(),
            'email'   => $request->string('email')->trim()->value(),
            'message' => $request->string('message')->trim()->value(),
            'intent'  => $request->intent(),
            'ip'      => $request->ip(),
        ];

        $sent = true;

        try {
            Mail::to(config('portfolio.contact.email'))
                ->send(new ContactMessage($data));
        } catch (Throwable $e) {
            // Never show a stack trace to a visitor over a contact form —
            // log it, keep the enquiry, and tell them how else to reach me.
            $sent = false;
            Log::error('Contact form could not send mail', [
                'error' => $e->getMessage(),
                'from'  => $data['email'],
            ]);
            Log::info('Contact enquiry received', $data);
        }

        $status = $sent
            ? "Thanks {$data['name']} — your message is on its way. I'll reply soon."
            : 'Your message was received, but the mail service is unavailable. Please email me directly at '
                .config('portfolio.contact.email').'.';

        if ($request->expectsJson()) {
            return response()->json(['ok' => $sent, 'message' => $status], $sent ? 200 : 202);
        }

        return redirect()->to(route('home').'#contact')->with('status', $status);
    }
}
