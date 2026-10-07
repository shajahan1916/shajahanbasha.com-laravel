<?php

namespace Tests\Feature;

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    public function test_the_home_page_renders_every_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        foreach (config('portfolio.menu') as $item) {
            $response->assertSee('id="'.$item['id'].'"', false);
        }

        $response->assertSee(config('portfolio.profile.last'), false);
        $response->assertSee('swiper-slide', false);
    }

    public function test_every_configured_job_and_skill_appears(): void
    {
        $response = $this->get('/');

        foreach (config('portfolio.career') as $job) {
            $response->assertSee($job['role'], false);
        }

        foreach (config('portfolio.skills') as $skill) {
            $response->assertSee($skill['name'], false);
        }
    }

    public function test_the_cv_route_responds(): void
    {
        $response = $this->get('/cv');

        // 200 when the PDF is in place, 404 with a friendly message when it is not.
        $this->assertContains($response->status(), [200, 404]);
    }
}
