<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'inquiryCount' => Inquiry::count(),
            'unreadCount' => Inquiry::whereNull('read_at')->count(),
            'portfolioCount' => Project::count(),
            'teamCount' => TeamMember::count(),
            'recent' => Inquiry::latest()->limit(5)->get(),
        ]);
    }

    public function inquiries(): View
    {
        return view('admin.inquiries.index', [
            'inquiries' => Inquiry::latest()->paginate(20),
        ]);
    }

    public function showInquiry(Inquiry $inquiry): View
    {
        if ($inquiry->read_at === null) {
            $inquiry->update(['read_at' => now()]);
        }

        return view('admin.inquiries.show', [
            'inquiry' => $inquiry,
        ]);
    }

}
