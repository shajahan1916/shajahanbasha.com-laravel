<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PortfolioController extends Controller
{
    /**
     * Render the single-page portfolio.
     */
    public function index(): View
    {
        $menu   = config('portfolio.menu');
        $career = config('portfolio.career');

        return view('portfolio', [
            'profile'        => config('portfolio.profile'),
            'roles'          => config('portfolio.roles'),
            'stats'          => config('portfolio.stats'),
            'menu'           => $menu,
            'chips'          => config('portfolio.chips'),
            'about'          => config('portfolio.about'),
            'skills'         => config('portfolio.skills'),
            'skillsSummary'  => config('portfolio.skills_summary'),
            'deliver'        => config('portfolio.deliver'),
            'certifications' => config('portfolio.certifications'),
            'hire'           => config('portfolio.hire'),
            'career'         => $career,
            'contact'        => config('portfolio.contact'),
            'social'         => config('portfolio.social'),

            // Spelled-out counts so headings stay in sync with the data.
            'deliverCount'   => $this->spell(count(config('portfolio.deliver'))),
            'certCount'      => $this->spell(count(config('portfolio.certifications'))),
            'careerCount'    => $this->spell(count($career)),

            // Lets a Blade link jump to a slide without hard-coding its number.
            'slideIndex'     => array_flip(array_column($menu, 'id')),
        ]);
    }

    /**
     * Stream the CV, or 404 politely if it hasn't been uploaded yet.
     */
    public function cv(): BinaryFileResponse|Response
    {
        $path = public_path(config('portfolio.profile.cv'));

        if (! is_file($path)) {
            return response('The CV is not available for download right now.', 404);
        }

        $name = str($this->profileName())->slug()->append('-cv.pdf')->value();

        return response()->download($path, $name, [], 'inline');
    }

    protected function profileName(): string
    {
        return (string) config('portfolio.profile.name', 'resume');
    }

    /**
     * Small number to word, so "6 things" reads as "Six things".
     */
    protected function spell(int $number): string
    {
        $words = [
            1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five',
            6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten',
            11 => 'eleven', 12 => 'twelve',
        ];

        return $words[$number] ?? (string) $number;
    }
}
