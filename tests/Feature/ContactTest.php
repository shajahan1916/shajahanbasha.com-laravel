<?php

namespace Tests\Feature;

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    private array $valid = [
        'name'    => 'Jane Doe',
        'email'   => 'jane@example.com',
        'message' => 'We are hiring a technical lead and would like to talk.',
        'intent'  => 'Job opportunity',
        'website' => '',
    ];

    public function test_a_valid_enquiry_is_mailed(): void
    {
        Mail::fake();

        $this->postJson('/contact', $this->valid)
            ->assertOk()
            ->assertJson(['ok' => true]);

        Mail::assertSent(ContactMessage::class, function (ContactMessage $mail) {
            return $mail->data['email'] === 'jane@example.com'
                && $mail->data['intent'] === 'Job opportunity';
        });
    }

    public function test_it_validates_the_input(): void
    {
        Mail::fake();

        $this->postJson('/contact', ['name' => '', 'email' => 'nope', 'message' => 'hi'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);

        Mail::assertNothingSent();
    }

    public function test_the_honeypot_blocks_bots(): void
    {
        Mail::fake();

        $this->postJson('/contact', array_merge($this->valid, ['website' => 'http://spam.test']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['website']);

        Mail::assertNothingSent();
    }

    public function test_a_plain_form_post_redirects_home_with_a_status(): void
    {
        Mail::fake();

        $this->post('/contact', $this->valid)
            ->assertRedirect()
            ->assertSessionHas('status');
    }
}
