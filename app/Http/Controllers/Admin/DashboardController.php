<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_members' => Member::count(),
            'active_loans' => Loan::whereNull('return_date')->count(),
            'overdue_loans' => Loan::whereNull('return_date')
                ->where('due_date', '<', now())
                ->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
