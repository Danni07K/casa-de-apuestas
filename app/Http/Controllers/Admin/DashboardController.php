<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\BetType;
use App\Models\PaymentMethod;
use App\Models\Announcement;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $data = [
            'activeEvents' => Event::where('status', 'scheduled')->count(),
            'betTypes' => BetType::count(),
            'activePaymentMethods' => PaymentMethod::where('status', 'active')->count(),
            'activeAnnouncements' => Announcement::where('is_active', true)->count(),
            'upcomingEvents' => Event::where('status', 'scheduled')
                ->orderBy('date')
                ->take(5)
                ->get(),
            'latestAnnouncements' => Announcement::latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', $data);
    }
} 