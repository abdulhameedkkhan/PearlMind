<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'featuredServices' => SiteContent::featuredServices(),
            'works' => array_slice(SiteContent::works(), 0, 6),
            'company' => SiteContent::company(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'company' => SiteContent::company(),
            'whyChoose' => SiteContent::whyChoose(),
        ]);
    }

    public function services(): View
    {
        return view('pages.services.index', [
            'services' => SiteContent::featuredServices(),
            'company' => SiteContent::company(),
        ]);
    }

    public function service(string $slug): View
    {
        $service = SiteContent::service($slug);

        abort_if($service === null, 404);

        return view('pages.services.show', [
            'service' => $service,
            'services' => SiteContent::featuredServices(),
            'works' => $service['show_portfolio'] ? SiteContent::works() : [],
            'socialClients' => $service['show_social'] ? SiteContent::socialClients() : [],
            'company' => SiteContent::company(),
            'related' => collect(SiteContent::services())
                ->reject(fn (array $item) => $item['slug'] === $slug)
                ->values()
                ->all(),
        ]);
    }

    public function portfolio(): View
    {
        return view('pages.portfolio', [
            'works' => SiteContent::works(),
            'company' => SiteContent::company(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'subjects' => SiteContent::contactSubjects(),
            'faqs' => SiteContent::faqs(),
            'company' => SiteContent::company(),
        ]);
    }

    public function contactStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['required', 'string', 'max:40'],
            'service' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thanks — we received your message and will get back to you shortly.');
    }
}
