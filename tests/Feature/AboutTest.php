<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_about_section_has_a_download_link_for_the_cv(): void
    {
        $paragraph = (object) [
            'title' => 'Over mij',
            'subtitle' => 'Introductie',
            'text' => 'Dit is de laatste alinea.',
        ];
        $html = view('sections.about', [
            'aboutHeader' => null,
            'aboutParagraphs' => collect([$paragraph]),
        ])->render();

        $this->assertStringContainsString('Download mijn CV', $html);
        $this->assertStringContainsString('download="CV-Piet-Korfmaker.pdf"', $html);
        $this->assertStringContainsString(asset('Downloads/CV-Piet-Korfmaker.pdf'), $html);
        $this->assertStringContainsString('hover:shadow-[0_0_50px_5px_#e00496]', $html);
        $lastParagraphPosition = strpos($html, 'Dit is de laatste alinea.');
        $downloadLinkPosition = strpos($html, 'Download mijn CV');
        $this->assertNotFalse($lastParagraphPosition);
        $this->assertNotFalse($downloadLinkPosition);
        $this->assertLessThan($downloadLinkPosition, $lastParagraphPosition);
        $this->assertFileExists(public_path('Downloads/CV-Piet-Korfmaker.pdf'));
    }
}
